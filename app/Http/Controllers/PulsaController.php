<?php

namespace App\Http\Controllers;

use App\Model\LogAdmin;
use App\Models\Reward;
use App\Repository\Pulsa;
use App\Repository\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PulsaController extends Controller
{
    private $transaksi;
    private $jumlahTransaksi;
    public function __construct(Pulsa $transaksi, Transaction $jumlahTransaksi)
    {
        $this->transaksi = $transaksi;
        $this->jumlahTransaksi = $jumlahTransaksi;
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['last_transaction'] = DB::table('table_pulsa as pl')
            ->leftJoin('table_provider as pv', 'pv.id', '=', 'pl.id_provider')
            ->leftJoin('table_nominal_pulsa as np', 'np.id', '=', 'pl.id_nominal')
            ->select('pl.id', 'pl.nomor_hp', 'np.nominal', 'pl.price','pv.nama_provider')
            ->orderBy('pl.created_at','desc')->limit(3)->get();
        $data['pulsa_nominal'] = DB::table('table_nominal_pulsa')->orderBy('nominal','asc')->get();
        $data['providers'] = DB::table('table_provider')->get();
        $data['user'] = DB::table('users')->find(auth()->user()->id);
        $data['all'] = $this->transaksi->getAll();
        $data['month'] = $this->transaksi->getByMonth();
        $data['week'] = $this->transaksi->getByWeek();

        return view('pulsa', $data);
    }

    public function post(Request $request){
        // dd($request);
        DB::beginTransaction();
        try {
            $harga_pulsa = DB::table('table_nominal_pulsa')->where('id', $request->nominal)->first()->fixed_price;
            $insertPulsa = [
                "outlet_id"              => Auth::id(),
                "nomor_hp"              => $request->phone_number,
                "id_provider"           => $request->provider,
                "id_nominal"            => $request->nominal,
                "price"                 => $harga_pulsa,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
            $beliPulsa = DB::table('table_pulsa')->insert($insertPulsa);
            $saldo = Auth::user()->saldo;
            $saldoNow = $saldo - $harga_pulsa;
            $user = DB::table('users')->where('id',auth()->user()->id);
            $user->update([
                'saldo'                 => $saldoNow,
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);

            DB::commit();
            $data['code']    = 200;
            $data['message'] = 'Berhasil Isi Ulang Pulsa ke nomor : '.$request->phone_number.'!';

            $transaction = $this->jumlahTransaksi->getTotalByMonth();
            $reward = Reward::whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->first();
            $total = $transaction->total_transaksi;
            if($total >= 30000000 && $total < 65000000){
                if ($reward == null) {
                    Reward::create([
                        'outlet_id' => Auth::id(),
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

            return response()->json($data);

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            $data['code']    = 500;
            $data['message'] = 'Maaf ada yang Error!';
            // var_dump($e);
            return response()->json($data);
        }
    }



}
