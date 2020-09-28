<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellingItemController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSellingItem(Request $request, $id)
    {

        // session()->forget('cart');

        dd(session()->get('cart'));

        // $cart = session()->get('cart');

        // if (!$cart) {

        //     $cart = [
        //         $id => [
        //             "name" => 4,
        //             "quantity" => 1,
        //             "price" => 2,
        //             "photo" => 5
        //         ]
        //     ];

        //     session()->put('cart', $cart);

        //     return back()->with('status', 'Produto inserido com sucesso = !$cart');
        // }

        // if (isset($cart[$id])) {
        //     $cart[$id]['quantity']++;

        //     session()->put('cart', $cart);

        //     return back()->with('status', 'Produto inserido com sucesso = isset($cart[$id]');
        // }

        // $cart[$id] = [
        //     "name" => 4,
        //     "quantity" => 1,
        //     "price" => 2,
        //     "photo" => 5
        // ];

        // session()->put('cart', $cart);

        // return redirect()->back()->with('success', 'Product added to cart successfully!');
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
}
