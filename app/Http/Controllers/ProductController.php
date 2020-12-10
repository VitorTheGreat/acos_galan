<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Storage;
use App\Models\Control_storage;
use App\Http\Requests\ProductRequest;

//using for the db views
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $search_query = request()->search_query;
    // $products_view = DB::select('SELECT * FROM product_total_quantity_view'); // view with total sum of total products

    $suppliers = Supplier::all();
    $storages = Storage::all();
    $product_within_storages = DB::select('SELECT * FROM product_quantity_by_storage_view ORDER BY descricao'); // view with total sum of total products

    if ($search_query == '') {
      $products_view = DB::table('product_total_quantity_view')->orderBy('descricao', 'ASC')->paginate(20);
    } else {
      $products_view = DB::table('product_total_quantity_view')->where('descricao', 'LIKE', '%' . $search_query . '%')->orderBy('descricao', 'ASC')->paginate(20);
    }

    return view('produto.actions', compact('products_view', 'suppliers', 'storages', 'product_within_storages'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request)
  {

    //We have to store the product
    //then we have to store the quantity

    $dataProduct = $request->except(['quantidade', 'unidade_venda', 'storage_id']);
    $dataControleStorage = $request->only(['quantidade', 'unidade_venda', 'storage_id']);

    // dd($dataProduct, $dataControleStorage);

    try {

      $product = Product::create($dataProduct);

      if ($product) {

        $controlStorage = Control_storage::create([
          'quantidade' => $dataControleStorage['quantidade'],
          'unidade_venda' => $dataControleStorage['unidade_venda'],
          'storage_id' => $dataControleStorage['storage_id'],
          'produto_id' => $product['id']
        ]);

        return back()->with('status', 'Produto Criado com Sucesso');
      }
    } catch (\Exception $e) {

      // return ['msg_error => ' => $e->getMessage()];
      if ($e->errorInfo[1] == 1062) {
        return back()->withError("Produto ja cadastrado, confira os dados");
      }
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Product $product, ProductRequest $request)
  {

    $dataProduct = $request->except(['quantidade', 'unidade_venda', 'storage_id']);

    // dd($product, $dataProduct);

    $product->update($dataProduct);

    return back()->with('status', 'Produto Alterado com sucesso!');
  }

  /**
   * Show the form for editing the profile.
   *
   * @return \Illuminate\View\View
   */
  public function show($productId)
  {

    // $product = Product::find($productId);
    $product = DB::table('product_total_quantity_view')->where('id', $productId)->first();

    $suppliers = Supplier::all();
    $storages = Storage::all();
    $product_within_storages = DB::select('SELECT * FROM product_quantity_by_storage_view'); // view with total sum of total products

    return view('produto.show', compact('product', 'suppliers', 'storages', 'product_within_storages'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    $product->delete();

    return back()->with('status', 'Produto deletado com Sucesso');
  }


  /**
   *  transfer page
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function transfer(Product $product)
  {

    $product_storages = DB::select('SELECT * FROM product_quantity_by_storage_view'); // view with total sum of total products

    return view('produto.transfer', compact('product_storages'));
  }

  /**
   *  Autocomplete Search
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function autocompleteSearch(Request $request)
  {

    $search = $request->get('term');

    $result = DB::table('product_quantity_by_storage_view')->select('*')->where('descricao', 'LIKE', '%' . $search . '%')->get();

    return response()->json($result);
  }
}
