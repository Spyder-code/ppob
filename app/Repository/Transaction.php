<?php

namespace App\Repository;

use App\Models\RiwayatSaldo;
use Illuminate\Support\Facades\Auth;

class Transaction
{
    private $pln;
    private $pulsa;
    private $paketData;

    public function __construct(Pln $pln, Pulsa $pulsa, PaketData $paketData)
    {
        $this->pln = $pln;
        $this->pulsa = $pulsa;
        $this->paketData = $paketData;
    }

    public function getAllData($id = 0)
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getAll($id),
            $this->pulsa->getAll($id),
            $this->paketData->getAll($id)
        ]);
        return $data;
    }

    public function getAllDataByMonth($id = 0)
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getByMonth($id),
            $this->pulsa->getByMonth($id),
            $this->paketData->getByMonth($id)
        ]);
        return $data;
    }

    public function getAllDataByWeek($id = 0)
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getByWeek($id),
            $this->pulsa->getByWeek($id),
            $this->paketData->getByWeek($id)
        ]);
        return $data;
    }

    public function getTotalByMonth()
    {
        $total_pln = $this->pln->getByMonth()->sum('price');
        $total_pulsa = $this->pulsa->getByMonth()->sum('price');
        $total_paket_data = $this->paketData->getByMonth()->sum('price');
        $total_transaksi = $total_pln + $total_pulsa + $total_paket_data;
        return (object)[
            'total_pln' => $total_pln,
            'total_pulsa' => $total_pulsa,
            'total_paket_data' => $total_paket_data,
            'total_transaksi' => $total_transaksi
        ];
    }

    public function getTotalByWeek()
    {
        $total_pln = $this->pln->getByWeek()->sum('price');
        $total_pulsa = $this->pulsa->getByWeek()->sum('price');
        $total_paket_data = $this->paketData->getByWeek()->sum('price');
        $total_transaksi = $total_pln + $total_pulsa + $total_paket_data;
        return (object)[
            'total_pln' => $total_pln,
            'total_pulsa' => $total_pulsa,
            'total_paket_data' => $total_paket_data,
            'total_transaksi' => $total_transaksi
        ];
    }

    public function getTotalGroupBy()
    {
        $total_pln = $this->pln->getAllDataGroupBy();
        $total_pulsa = $this->pulsa->getAllDataGroupBy();
        $total_paket_data = $this->paketData->getAllDataGroupBy();
        $total_transaksi = $total_pln + $total_pulsa + $total_paket_data;
        return (object)[
            'total_pln' => $total_pln,
            'total_pulsa' => $total_pulsa,
            'total_paket_data' => $total_paket_data,
            'total_transaksi' => $total_transaksi
        ];
    }

    // get Saldo History By Month
    public function getSaldoHistoryByMonth()
    {
        $data = RiwayatSaldo::where('outlet_id', Auth::id())->whereMonth('created_at', date('m'))->get();
        return $data;
    }
}
