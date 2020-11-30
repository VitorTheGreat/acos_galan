<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        //vendas geral é sem filtro
        $vendas_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->paginate(10);
        //vendas de hoje - filtro pro data
        $vendas_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->paginate(10);
        //vendas por semana - filtro de data até uma data
        $vendas_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->paginate(10);
        //vendas por mes - filtro de data mensaç
        $vendas_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->paginate(10);

        
        $total_vendas_hoje = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_hoje'))->whereDate('updated_at', Carbon::today())->get()->first();
        $total_vendas_semana = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_semana'))->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->get()->first();
        $total_vendas_mes = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_mes'))->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->get()->first();
        
        // dd($total_vendas_semana);
        
        return view('relatorios.index', compact(['vendas_geral', 'vendas_hoje', 'vendas_semana', 'vendas_mes', 'total_vendas_hoje', 'total_vendas_semana', 'total_vendas_mes']));
    }

    public function detailsVenda($id) {
        
        $venda = DB::table('selling_view')->select('*')->where('id', $id)->get();

        // dd($venda);

        return view('relatorios.vendaDetail', compact(['venda']));
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
