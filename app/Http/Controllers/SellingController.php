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

use App\Http\Controllers\CartController;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::orderBy('nome')->get();
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

        $button = $request->input('btn_selling');
        
        $cart = session()->get('cart', []);
        $customerData = $request->only(['nome', 'endereco', 'telefone', 'cpf', 'rg', 'email', 'celular', 'bairro', 'cep', 'cidade', 'states_id']);
        $paidValues = $request->only(['metodo_pagamento', 'desconto', 'valor_pago', 'sub_total_real', 'sub_total', 'troco', 'observacao']);
        $customer = Customer::where('cpf', $customerData['cpf'])->get()->first();
        
        if($button == 'close_selling') {
            
            try {
                if(!$customer) {
                    $customer = Customer::create($customerData);
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

                    $sellingId = $item['sellings_id'];

                    Control_storage::where('produto_id', $item['product_id'])->where('storage_id', $item['storage_id'])->decrement('quantidade', $item['quantidade']);

                }

                Selling::where('id', $sellingId)
                                    ->update([
                                        'metodo_pagamento' => $paidValues['metodo_pagamento'],
                                        'valor_pago' => $paidValues['valor_pago'],
                                        'valor_desconto' => $paidValues['desconto'],
                                        'preco_total_desconto' => $paidValues['sub_total'],
                                        'total' => $paidValues['sub_total_real'],
                                        'troco' => $paidValues['troco'],
                                        'status_venda' => 'venda_fechada',
                                        'observacao' => $paidValues['observacao'],
                                        'customer_id' => $customer->id
                                    ]);

                $request->session()->forget('cart');

                return redirect()->route('venda.pdf', ['id' => $sellingId]);


            } catch (\Exception $e) {
                dd($e);
            }
        }
        else if($button == 'save_budget') {
            try {
                
                if(!$customer) {
                    $customer = Customer::create($customerData);
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

                    $sellingId = $item['sellings_id'];

                    // Control_storage::where('produto_id', $item['product_id'])->where('storage_id', $item['storage_id'])->decrement('quantidade', $item['quantidade']);

                }

                Selling::where('id', $sellingId)
                                    ->update([
                                        'metodo_pagamento' => $paidValues['metodo_pagamento'],
                                        'valor_pago' => $paidValues['valor_pago'],
                                        'valor_desconto' => $paidValues['desconto'],
                                        'preco_total_desconto' => $paidValues['sub_total'],
                                        'total' => $paidValues['sub_total_real'],
                                        'troco' => $paidValues['troco'],
                                        'status_venda' => 'orcamento',
                                        'observacao' => $paidValues['observacao'],
                                        'customer_id' => $customer->id
                                    ]);

                $request->session()->forget('cart');

                return redirect()->route('venda.pdf', ['id' => $sellingId]);


            } catch (\Exception $e) {
                dd($e);
            }
        }


        // return view('movimentacao.vendas.sold');
    }


    public function orcamento() {

        session()->forget('cart');

        $orcamentos = DB::table('selling_view')->select('*')->where('status_venda', 'orcamento')->where('user_id', auth()->user()->id)->groupBy('id')->get();

        return view('movimentacao.orcamento', compact('orcamentos'));
    }

    public function editOrcamento($id) {

        $products = DB::select('SELECT * FROM selling_product_info_view WHERE estoque_id = ' . auth()->user()->storage_id);

        $selling_items = DB::select('SELECT * FROM selling_items WHERE sellings_id = ' . $id);

        // dd($selling_items);

        foreach ($selling_items as $prod) {
            app('App\Http\Controllers\CartController')->storeSellingItemOrcamento($prod->tabela, $prod->product_id, $prod->quantidade, $id);
        }

        $selling = Selling::where('id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('id', 'DESC')
                    ->first();
        

        return view('movimentacao.orcamentos.editOrcamento', compact('selling', 'products'));
    }

    public function changeTableOrcamento(Request $request, $id) {
        // dd($request->tabela, $id, session()->get('cart'));

        $selling_items = DB::select('SELECT * FROM selling_items WHERE sellings_id = ' . $id);

        foreach ($selling_items as $prod) {
            app('App\Http\Controllers\CartController')->storeSellingItemOrcamento($request->tabela, null, $prod->quantidade, $id);
        }

        return redirect()->back();

    }

    public function closeOrcamento($id) {

        $cart = session()->get('cart');

        $subTotal_venda = 0;

        
        if($cart) {
            
            foreach ($cart as $key => $item) {
                $subTotal_venda += $item['sub_total_produto'];
            }
    
            $sub_total = (float) number_format((float)$subTotal_venda, 2, '.', '');

            try {
                
                foreach ($cart as $item) {
    
                if(!SellingItem::where('product_id',$item['product_id'])->where('sellings_id',$item['sellings_id'])->exists()) {
                    
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

                }

                Selling::where('id', $id)
                    ->update([
                        'valor_pago' => $sub_total,
                        'preco_total_desconto' => $sub_total,
                        'total' => $sub_total
                    ]);
                
            }

            }  catch (\Exception $e) {
                dd($e);
            }
        }

        $orcamento = DB::table('selling_view')->select('*')->where('status_venda', 'orcamento')->where('user_id', auth()->user()->id)->where('id', $id)->get();
        
        // dd($orcamento);

        return view('movimentacao.orcamentos.closeOrcamento', compact('orcamento'));

    }

    public function finishOrcamento(Request $request, $id) {

        $orcamento = DB::table('selling_view')->select('*')->where('status_venda', 'orcamento')->where('user_id', auth()->user()->id)->where('id', $id)->get();

        // dd($request->all(), $orcamento);

        try {

            foreach ($orcamento as $key => $item) {
                $sellingId = $item->id;
                
                Control_storage::where('produto_id', $item->product_id)->where('storage_id', $item->storage_id)->decrement('quantidade', $item->quantidade);
    
            }
    
            Selling::where('id', $sellingId)
                                ->update([
                                    'metodo_pagamento' => $request->metodo_pagamento,
                                    'valor_pago' => $request->valor_pago,
                                    'valor_desconto' => $request->desconto,
                                    'preco_total_desconto' => $request->sub_total,
                                    'total' => $request->sub_total_real,
                                    'troco' => $request->troco,
                                    'status_venda' => 'venda_fechada',
                                    'observacao' => $request->observacao,
                                    'customer_id' => $orcamento[0]->customer_id
                                ]);
    
            session()->forget('cart');
            
            return redirect()->route('venda.pdf', ['id' => $sellingId]);
        } catch (\Exception $e) {
            dd($e);
        }
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
