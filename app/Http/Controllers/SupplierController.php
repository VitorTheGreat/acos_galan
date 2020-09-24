<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\State;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $states = State::all();
      $suppliers = Supplier::all();

      return view('fornecedor.actions', compact('states', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = request()->validate([
          'razao_social' => 'required|min:3',
          'email' => 'required|min:3',
          'cnpj' => 'required|min:3',
          'ie' => 'required|min:3',
          'telefone' => 'required|min:3',
          'states_id' => 'required',
          'endereco' => 'required|min:3',
          'bairro' => 'required|min:3',
          'cidade' => 'required|min:3',
          'cep' => 'required|min:3',
      ]);

      try {

        $storage = Supplier::create($data);

        return back()->with('status', 'Fornecedor Registrado com Sucesso');

      } catch (\Exception $e) {
        // dd($e);
        return back()->withError($e->getMessage());
        // if($e->errorInfo[1] == 1062){
        //   return back()->withError("Este fornecedor ja foi cadastrado, por favor confira os dados");
        // }
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Supplier $supplier)
    {
      $data = request()->validate([
          'razao_social' => 'required|min:3',
          'email' => 'required|min:3',
          'cnpj' => 'required|min:3',
          'ie' => 'required|min:3',
          'telefone' => 'required|min:3',
          'states_id' => 'required',
          'endereco' => 'required|min:3',
          'bairro' => 'required|min:3',
          'cidade' => 'required|min:3',
          'cep' => 'required|min:3',
      ]);

      $supplier->update($data);

      return back()->with('status', 'Fornecedor alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
      $supplier->delete();

      return back()->with('status', 'Fornecedor deletado com Sucesso');
    }
}
