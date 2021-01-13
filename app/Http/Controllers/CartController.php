<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SellingItem;
use Illuminate\Http\Request;

class CartController extends Controller
{

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

    public function changeQuantityCartEditOrcamento(Request $request, $prod_id, $selling_id) {
        
        // dd($request->quantidade, $prod_id, $selling_id);

        $cart = session()->get('cart', []);

        $itemCheck = SellingItem::where('sellings_id', $selling_id)->where('product_id', $prod_id)->get();

        // dd($itemCheck[0]);

        if(count($itemCheck) > 0) {

            $updateOrcamento = SellingItem::where('sellings_id', $selling_id)->where('product_id', $prod_id)->update([
                        'sub_total_produto' => (float) $request->quantidade * $itemCheck[0]->preco_venda_final,
                        'preco_venda_final' => $itemCheck[0]->preco_venda_final,
                        'quantidade' => $request->quantidade
                    ]);

                    return back()->with('status', 'Quantidade Atualizada');
        }
        else {

                $cart[$prod_id]['quantidade'] = (float) $request->quantidade;
                $cart[$prod_id]['sub_total_produto'] = (float) $request->quantidade * $cart[$prod_id]['preco_venda'];

                session()->put('cart', $cart);

                return redirect()->back();
            
        }


    }

    public function removeItemEditOrcamento($prod_id, $selling_id) {
        
        $cart = session()->get('cart', []);

        $itemCheck = SellingItem::where('sellings_id', $selling_id)->where('product_id', $prod_id)->get();

        // dd($itemCheck[0]);

        if(count($itemCheck) > 0) {

            $updateOrcamento = SellingItem::where('sellings_id', $selling_id)->where('product_id', $prod_id)->delete();

            unset($cart[$prod_id]);

            session()->put('cart', $cart);

            return back()->with('status', 'Produto exlcuido do carrinho');
        }
        else {

            if (isset($cart[$prod_id])) {

                unset($cart[$prod_id]);

                session()->put('cart', $cart);
            }

                return redirect()->back();
            
        }
    }

    public function storeSellingItemOrcamento($tabela, $prod_id, $quantidade, $sellings_id)
    {
        
        // dd($tabela, $prod_id, $quantidade, $sellings_id);

        $t = $tabela;
        
        session()->put('tabela', (float) $t);

        $cart = session()->get('cart', []);

        if (!isset($prod_id)) {

            foreach ($cart as $key => $item) {
                $cart[$key]['tabela'] = (float) $t;
                $cart[$key]['preco_venda'] = ($cart[$key]['preco_base'] * ((float) $t / 100)) + $cart[$key]['preco_base'];
                $cart[$key]['sub_total_produto'] = (float) $quantidade * $cart[$key]['preco_venda'];

                $updateOrcamento = SellingItem::where('sellings_id', $sellings_id)->where('product_id', $cart[$key]['product_id'])->update([
                                        'sub_total_produto' => (float) $quantidade * $cart[$key]['preco_venda'],
                                        'preco_venda_final' => $item['preco_venda'],
                                        'tabela' => $t
                                    ]);

                session()->put('cart', $cart);
            }

            return back()->with('status', 'Tabela Atualizada');
        }
        
        $product = Product::find($prod_id);

        $preco_venda = ($product->preco_venda * ((float) $t / 100)) + $product->preco_venda;

        // dd('cart', $cart, auth()->user()->storage_id);

        if (!$cart) {

            $cart = [
                (int) $product->id => [
                    'tabela' => (float) $t,
                    'product_name' => $product->descricao,
                    'preco_base' => $product->preco_venda,
                    'kg_mt' => $product->qtd_fracionada,
                    'preco_kg_mt' => $product->preco_unitario,
                    'preco_venda' => $preco_venda,
                    'product_id' => (int) $product->id,
                    'quantidade' => (float) $quantidade,
                    'sub_total_produto' => (float) $quantidade * $preco_venda,
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

            $cart[$product->id]['quantidade'] = (float) $quantidade;
            $cart[$product->id]['sub_total_produto'] = (float) $quantidade * $preco_venda;

            session()->put('cart', $cart);

            return redirect()->back();
        }

        $cart[(int) $product->id] = [
            'tabela' => (float) $t,
            'product_name' => $product->descricao,
            'preco_base' => $product->preco_venda,
            'kg_mt' => $product->qtd_fracionada,
            'preco_kg_mt' => $product->preco_unitario,
            'preco_venda' => $preco_venda,
            'product_id' => (int) $product->id,
            'quantidade' => (float) $quantidade,
            'sub_total_produto' => (float) $quantidade * $preco_venda,
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
