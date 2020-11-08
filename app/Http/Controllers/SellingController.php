<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellingRequest;
use App\Models\Control_storage;
use App\Models\Selling;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SellingItem;
use App\Models\State;
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
        $states = State::all();
        $products = DB::select('SELECT * FROM selling_product_info_view WHERE estoque_id = ' . auth()->user()->storage_id);

        $selling = Selling::where('status_venda','venda_aberta')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->first();

        return view('movimentacao.vendas.selling', compact('customers', 'selling', 'products', 'states'));
    }

    /**
     * Store a newly created resource in selling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function openSelling(SellingRequest $request) {

      $user_id = auth()->user()->id;
      $storage_id = auth()->user()->storage_id;
      $customer_id = $request->customer_id;
      $date = str_replace(['-', ':', ' '], '', date('d-m-Y H:i:s'));
      $sellingId = $user_id.$storage_id.$date;
      
      $openSellingData = ['id' => $sellingId, 'user_id' => $user_id, 'customer_id' => $customer_id, 'status_venda' => 'venda_aberta'];
      
      try {

        $openSelling = Selling::create($openSellingData);

        return back()->with('status_venda', 'Venda Aberta com Sucesso');

      } catch (\Exception $e) {

        return ['msg_error => ' => $e->getMessage()];

      }

    }

    public function closeSelling(Request $request) {
        $cart = session()->get('cart', []);
        
        $customerId = $request->only(['customer_id']);
        
        if($customerId) {
            $customerData = Customer::find((int) $customerId['customer_id']);
        }
        else {
            $customerData = $request->only(['nome', 'endereco', 'telefone', 'cpf', 'rg', 'email', 'celular', 'bairro', 'cep', 'cidade', 'states_id']);
        }

        $subTotal_venda = 0;
        
        foreach ($cart as $key => $item) {
            $subTotal_venda += $item['sub_total_produto'];
        }
        
        $sub_total = (float) number_format((float)$subTotal_venda, 2, '.', '');

        return view('movimentacao.vendas.closeSelling', compact('cart', 'sub_total', 'customerData'));
    }

    public function sold(Request $request) {
        $cart = session()->get('cart', []);

        $customerData = $request->only(['nome', 'endereco', 'telefone', 'cpf', 'rg', 'email', 'celular', 'bairro', 'cep', 'cidade', 'states_id']);
        $paidValues = $request->only(['metodo_pagamento', 'desconto', 'valor_pago', 'sub_total_real', 'sub_total', 'troco']);

        $customer = Customer::where('cpf', $customerData['cpf'])->get()->first();

        // dd($cart, $customerData, $paidValues, $customer);

        try {
            
            if(!$customer) {
                Customer::create($customerData);
            }

            foreach ($cart as $key => $item) {
                SellingItem::create([
                    'quantidade' => $item['quantidade'],
                    'sub_total_produto' => $item['sub_total_produto'],
                    'preco_base' => $item['preco_base'],
                    'preco_venda_final' => $item['preco_venda'],
                    'tabela' => $item['tabela'],
                    'product_id' => $item['product_id'],
                    'storage_id' => $item['storage_id'],
                    'sellings_id' => $item['sellings_id']
                ]);

                Control_storage::where('produto_id', $item['product_id'])->where('storage_id', $item['storage_id'])->decrement('quantidade', $item['quantidade']);

            }

            Selling::where('id', $cart[1]['sellings_id'])
                                ->update([
                                    'metodo_pagamento' => $paidValues['metodo_pagamento'],
                                    'valor_pago' => $paidValues['valor_pago'],
                                    'valor_desconto' => $paidValues['desconto'],
                                    'preco_total_desconto' => $paidValues['sub_total'],
                                    'total' => $paidValues['sub_total_real'],
                                    'troco' => $paidValues['troco'],
                                    'status_venda' => 'venda_fechada',
                                    'customer_id' => $customer->id
                                ]);

            $request->session()->forget('cart');

            return redirect()->route('venda.pdf', ['id' => $cart[1]['sellings_id']]);


        } catch (\Exception $e) {
            dd($e);
        }


        // return view('movimentacao.vendas.sold');
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
        session()->forget('cart');

        try {
            $deletedSelling = Selling::where('id', $id)->delete();

            return back()->with('status', 'Venda Cancelada');

        } catch (\Exception $e) {
            dd($e);
        }


    }
}
