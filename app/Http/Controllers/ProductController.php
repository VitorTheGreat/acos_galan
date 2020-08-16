<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Storage;
use App\Models\Control_storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::all();
      $suppliers = Supplier::all();
      $storages = Storage::all();

      return view('produto.actions', compact('products', 'suppliers', 'storages'));
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

      $dataProduct = $request->except(['quantidade', 'unidade_venda']);
      $dataControleStorage = $request->only(['quantidade', 'unidade_venda']);


      try {

        $product = Product::create($dataProduct);

        if($product) {
            // dd($product->id);
            $controlStorage = Control_storage::create([
              'quantidade' => $dataControleStorage['quantidade'],
              'unidade_venda' => $dataControleStorage['unidade_venda'],
              'produto_id' => $product['id']
            ]);

            return back()->with('status', 'Produto Criado com Sucesso');
        }


      } catch (\Exception $e) {

        return ['msg_error => ' => $e->getMessage()];

      }


      // return back()->with('status', 'Produto Registrado com Sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
