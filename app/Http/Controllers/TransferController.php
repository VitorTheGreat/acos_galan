<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Control_storage;
use App\Http\Requests\TransferRequest;

class TransferController extends Controller
{
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
  public function openTransferOrder(TransferRequest $request)
  {

    // dd($request->all());

    try {
      //get total quantity of the storage
      $controlStorageGet = Control_storage::where('produto_id', $request->prod_id)
        ->where('storage_id', $request->estoque_fornece)
        ->first();

      //delete the quantity of the storage (so they cannot sell it)
      $controlStorageUpdate = Control_storage::where('produto_id', $request->prod_id)
        ->where('storage_id', $request->estoque_fornece)
        ->update(['quantidade' => ($controlStorageGet->quantidade - $request->qtd_prod)]);

      //Open the transfer order
      if ($controlStorageUpdate) {
        $transferOrder = Transfer::create($request->all());

        return back()->with('status', 'Ordem Aberta com sucesso');
      }
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
  public function closeTransferOrder(Transfer $transfer)
  {
    
    try {
      // dd($transfer);

      //close the transfer order
      Transfer::where('id', $transfer->id)->update(['status_transferencia' => 'ordem_fechada', 'responsavel_entrega' => request()->responsavel_entrega]);

      //add the product quantity to the new storage (who is receiving the product = 'estoque_recebe')
      Control_storage::where('produto_id', $transfer->prod_id)->where('storage_id', $transfer->estoque_recebe)->increment('quantidade', $transfer->qtd_prod);

      return redirect()->route('transfer.pdf', ['transfer' => $transfer]);

    } catch (\Exception $e) {

      return ['msg_error => ' => $e->getMessage()];

    }
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
