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

        $t = $request->only(['tabela']);

        session()->put('tabela', (float) $t['tabela']);

        $cart = session()->get('cart', []);

        if (!isset($request->product_id)) {
            foreach ($cart as $key => $item) {
                $cart[$key]['tabela'] = (float) $t['tabela'];
                $cart[$key]['preco_venda'] = ($cart[$key]['preco_base'] * ((float) $t['tabela'] / 100)) + $cart[$key]['preco_base'];
                $cart[$key]['sub_total_produto'] = (float) $cart[$key]['quantidade'] * $cart[$key]['preco_venda'];

                session()->put('cart', $cart);
            }

            return back()->with('status', 'Tabela Atualizada');
        }

        $product = Product::find($request->product_id);

        $preco_venda = ($product->preco_venda * ((float) $t['tabela'] / 100)) + $product->preco_venda;

        // dd('cart', $cart, auth()->user()->storage_id);

        if (!$cart) {

            $cart = [
                (int) $product->id => [
                    'tabela' => (float) $t['tabela'],
                    'product_name' => $product->descricao,
                    'preco_base' => $product->preco_venda,
                    'kg_mt' => $product->qtd_fracionada,
                    'preco_kg_mt' => $product->preco_unitario,
                    'preco_venda' => $preco_venda,
                    'product_id' => (int) $product->id,
                    'quantidade' => (float) $request->quantidade,
                    'sub_total_produto' => (float) $request->quantidade * $preco_venda,
                    'storage_id' => auth()->user()->storage_id,
                    'sellings_id' => (int) $sellings_id
                ]
            ];

            session()->put('cart', $cart);

            // dd('if !cart depois do put', $cart);

            return back()->with('status', 'Produto Adicionado.');
        }

        if (isset($cart[$product->id])) {
            // dd('if isse cart', $cart);

            $cart[$product->id]['quantidade'] = (float) $request->quantidade;
            $cart[$product->id]['sub_total_produto'] = (float) $request->quantidade * $preco_venda;

            session()->put('cart', $cart);

            return redirect()->back();
        }

        $cart[(int) $product->id] = [
            'tabela' => (float) $t['tabela'],
            'product_name' => $product->descricao,
            'preco_base' => $product->preco_venda,
            'kg_mt' => $product->qtd_fracionada,
            'preco_kg_mt' => $product->preco_unitario,
            'preco_venda' => $preco_venda,
            'product_id' => (int) $product->id,
            'quantidade' => (float) $request->quantidade,
            'sub_total_produto' => (float) $request->quantidade * $preco_venda,
            'storage_id' => auth()->user()->storage_id,
            'sellings_id' => (int) $sellings_id
        ];

        session()->put('cart', $cart);

        // dd('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado.');
    }

    public function removeSellingItem($id)
    {
        if ($id) {

            $cart = session()->get('cart');

            if (isset($cart[$id])) {

                unset($cart[$id]);

                session()->put('cart', $cart);
            }

            return redirect()->back();
        }
    }
}