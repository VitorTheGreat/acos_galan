<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\State;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        $customers = Customer::all();

        return view('cliente.actions', compact('customers', 'states'));
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

      $data = request()->validate([
          'nome' => 'required',
          'email' => 'required',
          'cpf' => 'required',
          'rg' => 'required',
          'telefone' => 'required',
          'celular' => 'required',
          'cep' => 'required',
          'cidade' => 'required',
          'bairro' => 'required',
          'states_id' => 'required',
          'endereco' => 'required',
      ]);

      try {
        $customer = Customer::create($data);

        return back()->with('status', 'Cliente cadastrado com sucesso');

      } catch (\Exception $e) {
        // dd($e);
        // return back()->withError($e->getMessage());
        if($e->errorInfo[1] == 1062){
          return back()->withError("Cliente ja cadastrado, por favor confira os dados");
        }
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
      $customer->delete();

      return back()->with('status', 'Cliente deletado com Sucesso');
    }
}
