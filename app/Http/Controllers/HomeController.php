<?php

namespace App\Http\Controllers;

//using for the db views
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $transfers = DB::select('SELECT * FROM transfers_view');

      return view('dashboard', compact('transfers'));
    }
}
