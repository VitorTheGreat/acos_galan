<?php

namespace App\Http\Controllers;

use App\Models\Selling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = ['title' => 'coding driver test title'];
        $pdf = PDF::loadView('generate_pdf', $data);

        return $pdf->download('codingdriver.pdf');
    }


    public function transferOrderClosedPdf($id)
    {

        // $transfer = Transfer::find($id);
        $transfer = DB::table('transfers_view')->select('*')->where('id', '=', $id)->get();

        $pdf = PDF::loadView('produto.transfer_order_pdf', compact('transfer'));

        return $pdf->setPaper('a4')->stream('ordem_de_transferencia.pdf');
    }

    public function vendaConcluidaPdf($id) {

        $venda = DB::table('selling_view')->select('*')->where('id', '=', $id)->get();

        $pdf = PDF::loadView('movimentacao.vendas.sold', compact('venda'));

        return $pdf->setPaper('a4')->stream('venda.pdf');

        // $venda = DB::table('vendas_view')->select('*')->where('id', '=', $id)->get();
    }
}
