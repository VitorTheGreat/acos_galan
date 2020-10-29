<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellingRequest;

use App\Models\Selling;
use App\Models\Customer;
use App\Models\Product;

//using for the db views
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::all();
        // $products = Product::all();
        $products = DB::select('SELECT * FROM selling_product_info_view WHERE estoque_id = ' . auth()->user()->storage_id);

        $selling = Selling::where('status_venda','venda_aberta')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->first();

        return view('movimentacao.vendas.selling', compact('customers', 'selling', 'products'));
    }

    /**
     * Store a newly created resource in selling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function openSelling(SellingRequest $request) {

      $user_id = auth()->user()->id;
      $customer_id = $request->customer_id;

      $openSellingData = ['user_id' => $user_id, 'customer_id' => $customer_id, 'status_venda' => 'venda_aberta'];

      // dd($user_id, $customer_id, $openSellingData);

      try {

        $openSelling = Selling::create($openSellingData);

        return back()->with('status_venda', 'Venda Aberta com Sucesso');

      } catch (\Exception $e) {

        return ['msg_error => ' => $e->getMessage()];

      }

    }

    public function sold() {
        return view('movimentacao.vendas.sold');
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
}
