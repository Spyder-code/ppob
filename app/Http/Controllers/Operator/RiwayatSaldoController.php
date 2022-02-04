<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\RiwayatSaldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RiwayatSaldoController extends Controller
{
    public function index(Request $request)
    {
        $link = url('/operator/print');
        $name = $request->name;
        $saldo = $request->saldo;
        $users = \App\Models\User::where('role', 'outlet')
        // ->orderBy('name', 'desc')
        ->paginate(5);
        foreach ($users as $key) {
            $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
            ->count();
            $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
            ->orderBy('saldoPlus', 'desc')
            // ->where(date('Y-m', strtotime('created_at')), date('Y-m'))
            ->sum('saldoPlus');
            // foreach ($key->total_topup as $total_topup) {
            //     $total_topup->created_at->date_format('Y-m') == date('Y-m');
            // }
        }
        // dd($users);
        return view('operator.datariwayat.index', compact('users', 'link', 'name', 'saldo'));
    }

    public function filter(Request $request)
    {
        $link = url('/operator/print/filter');
        $name = $request->name;
        $saldo = $request->saldo;

        // dd($request);

        if ($name == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('saldo','like',"%".$saldo."%")
            // ->orderBy('created_at', 'desc')
            ->paginate(5);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } elseif ($saldo == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            // ->orderBy('created_at', 'desc')
            ->paginate(5);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } elseif ($name != null && $saldo != null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            ->where('saldo','like',"%".$saldo."%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } else {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->paginate(5);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        }


        return view('operator.datariwayat.index', compact('users', 'link', 'name', 'saldo'));
    }

    public function print()
    {
        $users = \App\Models\User::where('role', 'outlet')
        // ->orderBy('name', 'desc')
        ->paginate(10000);
        foreach ($users as $key) {
            $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
            ->count();
            $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
            ->orderBy('saldoPlus', 'desc')
            // ->where(date('Y-m', strtotime('created_at')), date('Y-m'))
            ->sum('saldoPlus');
            // foreach ($key->total_topup as $total_topup) {
            //     $total_topup->created_at->date_format('Y-m') == date('Y-m');
            // }
        }
        // dd($users);
        return view('operator.datariwayat.print', compact('users'));
    }

    public function printFilter(Request $request)
    {
        $name = $request->name;
        $saldo = $request->saldo;

        // dd($request);

        if ($name == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('saldo','like',"%".$saldo."%")
            // ->orderBy('created_at', 'desc')
            ->paginate(1000);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } elseif ($saldo == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            // ->orderBy('created_at', 'desc')
            ->paginate(1000);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } elseif ($name != null && $saldo != null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            ->where('saldo','like',"%".$saldo."%")
            ->orderBy('created_at', 'desc')
            ->paginate(1000);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        } else {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->paginate(1000);
            foreach ($users as $key) {
                $key->total = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->count();
                $key->total_topup = \App\Models\RiwayatSaldo::where('user_id', $key->id)
                ->sum('saldoPlus');
            }

        }


        return view('operator.datariwayat.print', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        // get transaction hostory all
        $all = RiwayatSaldo::where('user_id', $id)->get();

        // get transaction history by month
        $month = RiwayatSaldo::whereMonth('created_at', date('m'))->where('user_id', $id)->get();

        // get transaction history by week
        $week = RiwayatSaldo::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('user_id', $id)->get();
        return view('operator.datariwayat.detail', compact('all', 'month', 'week', 'user'));
    }

}
