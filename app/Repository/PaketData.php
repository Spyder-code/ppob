<?php
namespace App\Repository;

use App\Models\PaketData as ModelsPaketData;
use Illuminate\Support\Facades\Auth;

class PaketData
{
    private $paketData;
    public function __construct(ModelsPaketData $paketData)
    {
        $this->paketData = $paketData;
    }

    public function getAll()
    {
        return $this->paketData->all()->where('outlet_id', Auth::id());
    }

    public function getById($id)
    {
        return $this->paketData->find($id);
    }

    public function getByMonth()
    {
        return $this->paketData->whereMonth('created_at', date('m'))->where('outlet_id', Auth::id())->get();
    }

    public function getByWeek()
    {
        // laravel where clause by week
        return $this->paketData->where('outlet_id', Auth::id())->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ])->get();
    }
}