<?php

namespace App\Repository;

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

    public function getAllData()
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getAll(),
            $this->pulsa->getAll(),
            $this->paketData->getAll()
        ]);
        return $data;
    }

    public function getAllDataByMonth()
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getByMonth(),
            $this->pulsa->getByMonth(),
            $this->paketData->getByMonth()
        ]);
        return $data;
    }

    public function getAllDataByWeek()
    {
        // laravel merge collection
        $data = collect([
            $this->pln->getByWeek(),
            $this->pulsa->getByWeek(),
            $this->paketData->getByWeek()
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
}