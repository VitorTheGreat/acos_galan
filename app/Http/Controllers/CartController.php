<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSellingItem(Request $request, $sellings_id)
    {

        $product = Product::find($request->product_id);

        // dd($product, $sellings_id);

        $cart = session()->get('cart', []);

        // dd('cart', $cart);

        if (!$cart) {

            $cart = [
                (int) $product->id => [
                    'product_name' => $product->descricao,
                    'preco_venda' => $product->preco_venda,
                    'product_id' => (int) $product->id,
                    'quantidade' => 1,
                    'sub_total_produto' => $product->preco_venda,
                    'sellings_id' => (int) $sellings_id
                    ]
                ];
                
                session()->put('cart', $cart);
                
                // dd('if !cart depois do put', $cart);

            return back()->with('status', 'Produto Adicionado.');
        }

        if(isset($cart[$product->id])) {
            // dd('if isse cart', $cart);
            return redirect()->back()->with('status', 'Produto ja esta no carrinho');
        }

        $cart[(int) $product->id] =[
            'product_name' => $product->descricao,
            'preco_venda' => $product->preco_venda,
            'product_id' => (int) $product->id,
            'quantidade' => 1,
            'sub_total_produto' => $product->preco_venda,
            'sellings_id' => (int) $sellings_id
        ];

        session()->put('cart', $cart);

        // dd('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado.');
    }

    public function removeSellingItem($id) {
        if($id) {

            $cart = session()->get('cart');

            if(isset($cart[$id])) {
                
                unset($cart[$id]);

                session()->put('cart', $cart);
            }

            return redirect()->back();
        }
    }
}
