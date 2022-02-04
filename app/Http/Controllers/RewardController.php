<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\RiwayatSaldo;
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
        $total = RiwayatSaldo::where('user_id', Auth::id())->whereMonth('created_at', date('m'))->sum('saldoPlus');
        $data = Reward::all()->where('outlet_id', Auth::id())->where('status', 1);
        $reward = Reward::whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->where('status',0)->first();
        if ($reward!=null) {
            if ($reward->reward=='Emas 0.5 gram') {
                $type = 1;
            }else if($reward->reward=='Emas 1 gram'){
                $type = 2;
            }else if($reward->reward=='Emas 3 gram'){
                $type = 3;
            }
        }else{
            $reward = Reward::whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->where('status',1)->get();
            if ($reward->count() > 0) {
                $type = 4;
            }else{
                $type = 0;
            }
        }
        return view('reward.index', compact('data','transaction','type','total'));
    }

    public function ambilReward()
    {
        $reward = Reward::all()->where('status',0)->where('outlet_id', Auth::id())->first();
        Reward::find($reward->id)->update([
            'status' => 1
        ]);
        return redirect()->back()->with('success', 'Anda berhasil mengambil reward');
    }
}
