<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;

class StorageController extends Controller
{
    //Locking the page, the user can only see it if he is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $storages = Storage::all();

      return view('estoque.actions', compact('storages'));
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
            'name' => 'required|min:3',
            'local' => 'required|min:3',
        ]);

      try {
        $storage = Storage::create($data);

        return back()->with('status', 'Estoque Criado com Sucesso');

      } catch (\Exception $e) {
        // dd($e);
        // return back()->withError($e->getMessage());
        if($e->errorInfo[1] == 1062){
          return back()->withError("Este estoque ja foi cadastrado, por favor confira os dados");
        }
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Storage $storage)
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'local' => 'required|min:3',
        ]);

        $storage->update($data);

        return back()->with('status', 'Estoque Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {

        $storage->delete();

        return back()->with('status', 'Estoque Deletado com Sucesso');

    }
}
