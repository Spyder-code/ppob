<?php

namespace App\Http\Controllers;

use App\Repository\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $transaksi;
    public function __construct(Transaction $transaksi)
    {
        $this->transaksi = $transaksi;
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // \Carbon::parse('2019-03-01')->formatLocalized('d F Y');
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home');
        }elseif (auth()->user()->role == 'operator') {
            return view('home');
        }else{
            return redirect()->route('landingpage');
        }
    }

    public function history()
    {
        $all = $this->transaksi->getAllData();
        $month = $this->transaksi->getAllDataByMonth();
        $week = $this->transaksi->getAllDataByWeek();
        return view('history', compact('all', 'month', 'week'));
    }
}
