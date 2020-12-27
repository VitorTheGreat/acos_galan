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
    public function index(Request $request)
    {
      $search_query = request()->search_query;

      if($request->has("orderByDate")) {
        // dd($request->orderByDate);

        //vendas geral é sem filtro
        $vendas_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'venda_fechada')->orderBy('updated_at', $request->orderByDate)->paginate(10);
        //vendas de hoje - filtro pro data
        $vendas_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'venda_fechada')->orderBy('updated_at', $request->orderByDate)->paginate(10);
        //vendas por semana - filtro de data até uma data
        $vendas_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'venda_fechada')->orderBy('updated_at', $request->orderByDate)->paginate(10);
        //vendas por mes - filtro de data mensaç
        $vendas_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'venda_fechada')->orderBy('updated_at', $request->orderByDate)->paginate(10);
      }

      else if($search_query != '') {

        //vendas geral é sem filtro
        $vendas_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'venda_fechada')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
        //vendas de hoje - filtro pro data
        $vendas_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'venda_fechada')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
        //vendas por semana - filtro de data até uma data
        $vendas_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'venda_fechada')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
        //vendas por mes - filtro de data mensaç
        $vendas_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'venda_fechada')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
      }

      else{
        //vendas geral é sem filtro
        $vendas_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'venda_fechada')->paginate(10);
        //vendas de hoje - filtro pro data
        $vendas_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'venda_fechada')->paginate(10);
        //vendas por semana - filtro de data até uma data
        $vendas_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'venda_fechada')->paginate(10);
        //vendas por mes - filtro de data mensaç
        $vendas_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'venda_fechada')->paginate(10);

      }


        $total_vendas_hoje = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_hoje'))->whereDate('updated_at', Carbon::today())->where('status_venda', 'venda_fechada')->get()->first();
        $total_vendas_semana = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_semana'))->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'venda_fechada')->get()->first();
        $total_vendas_mes = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_mes'))->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'venda_fechada')->get()->first();

        // dd($total_vendas_semana);

        return view('relatorios.index', compact(['vendas_geral', 'vendas_hoje', 'vendas_semana', 'vendas_mes', 'total_vendas_hoje', 'total_vendas_semana', 'total_vendas_mes']));
    }

    public function detailsVenda($id) {

        $venda = DB::table('selling_view')->select('*')->where('id', $id)->get();

        // dd($venda);

        return view('relatorios.vendaDetail', compact(['venda']));
    }

    public function relatoriosOrcamentos(Request $request) {

                $search_query = request()->search_query;

                if($request->has("orderByDate")) {
                  //orcamentos geral é sem filtro
                  $orcamentos_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'orcamento')->orderBy('updated_at', $request->orderByDate)->paginate(10);
                  //orcamentos de hoje - filtro pro data
                  $orcamentos_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'orcamento')->orderBy('updated_at', $request->orderByDate)->paginate(10);
                  //orcamentos por semana - filtro de data até uma data
                  $orcamentos_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'orcamento')->orderBy('updated_at', $request->orderByDate)->paginate(10);
                  //orcamentos por mes - filtro de data mensaç
                  $orcamentos_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'orcamento')->orderBy('updated_at', $request->orderByDate)->paginate(10);
                }

                else if($search_query != '') {
                  //orcamentos geral é sem filtro
                  $orcamentos_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'orcamento')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
                  //orcamentos de hoje - filtro pro data
                  $orcamentos_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'orcamento')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
                  //orcamentos por semana - filtro de data até uma data
                  $orcamentos_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'orcamento')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
                  //orcamentos por mes - filtro de data mensaç
                  $orcamentos_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'orcamento')->where('nome', 'LIKE', '%' . $search_query . '%')->paginate(10);
                }

                else{
                  //orcamentos geral é sem filtro
                  $orcamentos_geral = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->where('status_venda', 'orcamento')->paginate(10);
                  //orcamentos de hoje - filtro pro data
                  $orcamentos_hoje = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereDate('updated_at', Carbon::today())->where('status_venda', 'orcamento')->paginate(10);
                  //orcamentos por semana - filtro de data até uma data
                  $orcamentos_semana = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'orcamento')->paginate(10);
                  //orcamentos por mes - filtro de data mensaç
                  $orcamentos_mes = DB::table('selling_view')->select('*', DB::raw('count(*) as total_produtos'))->groupBy('id')->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'orcamento')->paginate(10);
                }

                $total_orcamentos_hoje = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_hoje'))->whereDate('updated_at', Carbon::today())->where('status_venda', 'orcamento')->get()->first();
                $total_orcamentos_semana = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_semana'))->whereRaw('WEEKOFYEAR(updated_at) = WEEKOFYEAR(NOW())')->where('status_venda', 'orcamento')->get()->first();
                $total_orcamentos_mes = DB::table('sellings')->select(DB::raw('sum(preco_total_desconto) as total_mes'))->whereRaw('YEAR(updated_at) = YEAR(NOW()) AND MONTH(updated_at)=MONTH(NOW())')->where('status_venda', 'orcamento')->get()->first();

                // dd($total_orcamentos_semana);

                return view('relatorios.relatoriosOrcamentos', compact(['orcamentos_geral', 'orcamentos_hoje', 'orcamentos_semana', 'orcamentos_mes', 'total_orcamentos_hoje', 'total_orcamentos_semana', 'total_orcamentos_mes']));
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
