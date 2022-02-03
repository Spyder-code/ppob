<?php
namespace App\Repository;

use App\Models\Pulsa as ModelsPulsa;
use Illuminate\Support\Facades\Auth;

class Pulsa
{
    private $pulsa;
    public function __construct(ModelsPulsa $pulsa)
    {
        $this->pulsa = $pulsa;
    }

    public function getAll()
    {
        return $this->pulsa->all()->where('outlet_id', Auth::id());
    }

    public function getById($id)
    {
        return $this->pulsa->find($id);
    }

    public function getByMonth()
    {
        return $this->pulsa->whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->get();
    }

    public function getByWeek()
    {
        // laravel where clause by week
        return $this->pulsa->where('outlet_id', Auth::id())->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ])->get();
    }
}