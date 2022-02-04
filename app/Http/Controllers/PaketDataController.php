<?php

namespace App\Http\Controllers;

use App\Model\LogAdmin;
use App\Models\Reward;
use App\Repository\PaketData;
use App\Repository\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PaketDataController extends Controller
{
    private $transaksi;
    private $jumlahTransaksi;
    public function __construct(PaketData $transaksi, Transaction $jumlahTransaksi)
    {
        $this->transaksi = $transaksi;
        $this->jumlahTransaksi = $jumlahTransaksi;
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['last_transaction'] = DB::table('table_paket_data as pl')
            ->leftJoin('table_nominal_data as np', 'np.id', '=', 'pl.id_paket_data')
            ->leftJoin('table_provider as pv', 'pv.id', '=', 'np.id_provider')
            ->select('pl.id', 'pl.nomor_hp', 'np.nama_paket', 'pl.price','pv.nama_provider')
            ->orderBy('pl.created_at','desc')->limit(3)->get();
        $data['paket_data'] = DB::table('table_nominal_data as dt')
            ->leftJoin('table_provider as pv', 'pv.id', '=', 'dt.id_provider')
            ->select('dt.id', 'dt.id_provider', 'dt.nama_paket', 'dt.fixed_price','pv.nama_provider')
            ->orderBy('dt.id_provider','asc')->get();
        $data['user'] = DB::table('users')->find(auth()->user()->id);
        $data['all'] = $this->transaksi->getAll();
        $data['month'] = $this->transaksi->getByMonth();
        $data['week'] = $this->transaksi->getByWeek();

        return view('paket_data', $data);
    }

    public function post(Request $request){
        DB::beginTransaction();
        try {
            $harga_paket = DB::table('table_nominal_data')->where('id', $request->jenis_paket)->first()->fixed_price;
            $insertPulsa = [
                "outlet_id"              => Auth::id(),
                "nomor_hp"              => $request->phone_number,
                "id_paket_data"            => $request->jenis_paket,
                "id_provider"            => $request->id_provider,
                "price"                 => $harga_paket,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
            $beliPulsa = DB::table('table_paket_data')->insert($insertPulsa);
            $saldo = Auth::guard('web')->user()->saldo;
            $saldoNow = $saldo - $harga_paket;
            $user = DB::table('users')->where('id',auth()->user()->id);
            $user->update([
                'saldo'                 => $saldoNow,
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);

            DB::commit();
            $data['code']    = 200;
            $data['message'] = 'Berhasil Isi Ulang Paket Data ke nomor : '.$request->phone_number.'!';

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
            $data['message'] = 'Maaf Ada yang Error!';
            // var_dump($e);
            return response()->json($e);
        }
    }



}
