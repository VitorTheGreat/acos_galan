<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    $search_query = request()->search_query;

    $states = State::all();

    if ($search_query == '') {
      $customers = Customer::orderBy('nome', 'ASC')->paginate(10);
    } else {
      $customers = DB::table('customers')->where('nome', 'LIKE', '%' . $search_query . '%')->orderBy('nome', 'ASC')->paginate(10);
    }

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

    // $data = request()->validate([
    //   'nome' => 'required',
    //   // 'email' => 'required',
    //   // 'cpf' => 'required',
    //   // 'rg' => 'required',
    //   // 'telefone' => 'required',
    //   // 'celular' => 'required',
    //   'cep' => 'required',
    //   'cidade' => 'required',
    //   'bairro' => 'required',
    //   'states_id' => 'required',
    //   'endereco' => 'required',
    // ]);

    $data = request()->all();

    // dd($data);

    try {
      $customer = Customer::create($data);

      return back()->with('status', 'Cliente cadastrado com sucesso');
    } catch (\Exception $e) {
      // dd($e);
      // return back()->withError($e->getMessage());
      if ($e->errorInfo[1] == 1062) {
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
  public function show($customerId)
  {

    $customer = DB::table('customers')->where('id', $customerId)->first();

    $states = State::all();

    return view('cliente.show', compact('customer', 'states'));
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
  public function update(Customer $customer, Request $request)
  {
    
    $dataCustomer = $request->all();

    $customer->update($dataCustomer);

    return back()->with('status', 'Cliente Atualizado com sucesso!');
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
