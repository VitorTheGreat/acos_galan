<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Storage;
use App\Models\Control_storage;

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
    public function store(Request $request)
    {

      //We have to store the product
      //then we have to store the quantity

      // $dataProduct = request()->validate([
      //     'descricao' => 'required|min:3',
      //     'unidade_venda' => 'required',
      //     'peso' => 'required|min:3',
      //     'preco_peso' => 'required',
      //     'preco_compra' => 'required',
      //     'preco_custo' => 'required',
      //     'preco_venda' => 'required',
      //     'lucro' => 'required',
      //     'ipi' => 'required',
      //     'icms' => 'required',
      //     'ncm' => 'required|min:3',
      //     'csosn' => 'required|min:3',
      //     'supplier_id' => 'required',
      //     'storage_id' => 'required',
      // ]);
      //
      // $dataControleStorage = request()->validate([
      //   'quantidade' => 'required',
      //   'quantidade_peso' => 'required',
      // ]);

      dd($request);
      // try {
      //
      //   $product = Product::create($dataProduct);
      //
      //   $controlStorage = Control_storage::create([
      //     'quantidade' => $dataControleStorage['quantidade'],
      //     'quantiade_peso' => $dataControleStorage['quantidade_peso'],
      //     'produto_id' => $product['id']
      //   ]);
      //
      // } catch (\Exception $e) {
      //
      //   return ['msg_error' => $e->getMessage()];
      //
      // }



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
    public function destroy($id)
    {
        //
    }
}
