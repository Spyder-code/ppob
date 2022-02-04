<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Repository\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function outlet()
    {
        return view('admin.datauser.index', [
            'users' => \App\Models\User::orderBy('name', 'asc')
            ->where('role', 'outlet')
            ->paginate(5)
        ]);
    }

    public function transactionHistory()
    {
        $all = $this->transaction->getAllData();
        $month = $this->transaction->getAllDataByMonth();
        $week = $this->transaction->getAllDataByWeek();
        return view('operator.datariwayat.transaksi', compact('all', 'month', 'week'));
    }

    public function transactionHistoryOutlet($id)
    {
        $all = $this->transaction->getAllData($id);
        $month = $this->transaction->getAllDataByMonth($id);
        $week = $this->transaction->getAllDataByWeek($id);
        return view('operator.datariwayat.transaksi', compact('all', 'month', 'week'));
    }
}
