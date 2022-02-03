<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Repository\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $transaction = $this->transaction->getTotalByMonth();
        $data = Reward::all()->where('outlet_id', Auth::id());
        $total = $transaction->total_transaksi;
        if ($total < 30000000) {
            $type = 0;
        }else if($total >= 30000000 && $total < 65000000){
            $reward = Reward::all()->where('outlet_id', Auth::id())->where('status', 0);
            if ($reward->count() > 0) {
                $is_take = false;
            }else{
                $is_take = true;
            }
            $type = 1;
        }else if($total >= 65000000 && $total < 130000000){
            $type = 2;
        }else if($total >= 130000000){
            $type = 3;
        }
        return view('reward.index', compact('data','transaction','type'));
    }
}
