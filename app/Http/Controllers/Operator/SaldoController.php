<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RiwayatSaldo;
use App\Models\User;
use App\Repository\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index($type)
    {
        if ($type==0) {
            $data = User::where('role','outlet')->with(['pln','pulsa','paketData','reward'])->get();
        }else if($type==1){
            $data = User::where('role','outlet')->with(['plnByMonth','pulsaByMonth','paketDataByMonth','rewardByMonth'])->get();
        } else if($type==2){
            $data = User::where('role','outlet')->with(['plnByWeek','pulsaByWeek','paketDataByWeek','rewardByWeek'])->get();
        }else{
            return abort(404);
        }
        return view('operator.datauser.index', compact('data','type'));
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $saldo = $request->saldo;

        // dd($request);

        if ($name == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('saldo','like',"%".$saldo."%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        } elseif ($saldo == null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        } elseif ($name != null && $saldo != null) {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->where('name','like',"%".$name."%")
            ->where('saldo','like',"%".$saldo."%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        } else {

            $users = \App\Models\User::orderBy('saldo', 'desc')
            ->where('role', 'outlet')
            ->paginate(5);

        }


        return view('operator.datauser.index', compact('users'));
    }

    public function updateStatusUser(Request $request, User $user)
    {
        User::find($user->id)->update($request->all());
        return back()->with('success', 'Status User Berhasil Diubah');
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
    public function edit(\App\Models\User $user)
    {
        $user = $user->find($user->id);
        $rs = \App\Models\RiwayatSaldo::orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate(5);
        // $rsaldo = DB::table('riwayat_saldos')->get()->sum('saldoPlus');
        $rsaldo = DB::table('riwayat_saldos')->where('user_id', $user->id)->get()->sum('saldoPlus');
        return view('operator.datauser.update', compact('user', 'rs', 'rsaldo'));
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
        $request->validate([
            'saldoPlus' => 'required|numeric',
        ]);

        $user = \App\Models\User::find($id);
        $saldo = $user->saldo;
        $saldoNow = $saldo + $request->saldoPlus;
        // dd($user);

        // buat riwayat saldo user
        \App\Models\RiwayatSaldo::create([
            'user_id'       => $user->id,
            'saldoAfter'    => $user->saldo,
            'saldoPlus'     => $request->saldoPlus,
            'saldoNow'      => $saldoNow,
        ]);

        $total = RiwayatSaldo::where('user_id', $user->id)->whereMonth('created_at', date('m'))->sum('saldoPlus');
        $reward = Reward::whereMonth('created_at', date('m'))->where('outlet_id', $user->id)->first();
            if($total >= 30000000 && $total < 65000000){
                if ($reward == null) {
                    Reward::create([
                        'outlet_id' => $user->id,
                        'reward' => 'Emas 0.5 gram',
                        'status' => 0,
                        'nominal' => 0.5,
                    ]);
                }
            }else if($total >= 65000000 && $total < 130000000){
                if ($reward != null) {
                    Reward::find($reward->id)->update([
                        'reward' => 'Emas 1 gram',
                        'nominal' => 1,
                    ]);
                }
            }else if($total >= 130000000){
                if ($reward != null) {
                    Reward::find($reward->id)->update([
                        'reward' => 'Emas 3 gram',
                        'nominal' => 3,
                    ]);
                }
            }
        // edit saldo user
        $user->update([
            'saldo'         => $saldoNow,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return back()->with('success', 'Saldo berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = \App\Models\User::find($id);
        $user->update([
            'status' => $request->status,
        ]);

        return redirect()->route('operator.saldo')->with('success', 'Saldo berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\Models\User::find($id);
        $user->delete();
        return back()->with('success', 'User di hapus!');
    }
}
