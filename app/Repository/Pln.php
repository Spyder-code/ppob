<?php
namespace App\Repository;

use App\Models\Pln as ModelsPln;
use Illuminate\Support\Facades\Auth;

class Pln
{
    private $pln;
    public function __construct(ModelsPln $pln)
    {
        $this->pln = $pln;
    }

    public function getAll()
    {
        return $this->pln->all()->where('outlet_id', Auth::id());
    }

    public function getById($id)
    {
        return $this->pln->find($id);
    }

    public function getByMonth()
    {
        return $this->pln->whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->get();
    }

    public function getByWeek()
    {
        // laravel where clause by week
        return $this->pln->where('outlet_id', Auth::id())->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ])->get();
    }
}