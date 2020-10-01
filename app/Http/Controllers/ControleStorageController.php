<?php

namespace App\Http\Controllers;

use App\Models\Control_storage;
use Illuminate\Http\Request;

class ControleStorageController extends Controller
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
    public function update(Request $request)
    {

        $request->validate([
            'quantidade' => 'required',
            'storage_id' => 'required',
            'product_id' => 'required',
        ]);

        // dd($request->all());
        try {

            Control_storage::where('storage_id', (int) $request->storage_id)
                ->where('produto_id', (int) $request->product_id)
                ->increment('quantidade', (float) $request->quantidade);


            return back()->with('status', 'Estoque Alterado com sucesso!');
        } catch (\Exception $e) {
            return ['msg_error => ' => $e->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function correctQuantity(Request $request, $id)
    {

        $request->validate([
            'quantidade' => 'required',
            'storage_id' => 'required',
            'product_id' => 'required',
        ]);

        $unidade_venda = Control_storage::where('produto_id', $id)->get(['unidade_venda']);

        try {

            $update = Control_storage::where('storage_id', (int) $request->storage_id)
                ->where('produto_id', (int) $request->product_id)
                ->update(['quantidade' => (float) $request->quantidade]);

            if (!$update) {
                $create = Control_storage::create([
                    'quantidade' => (float) $request->quantidade,
                    'unidade_venda' => $unidade_venda[0]->unidade_venda,
                    'storage_id' => (int) $request->storage_id,
                    'produto_id' => (int) $request->product_id
                ]);

                // dd($create);
            }

            return back()->with('status', 'Estoque Alterado com sucesso!');
        } catch (\Exception $e) {
            return ['msg_error => ' => $e->getMessage()];
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
        //
    }
}
