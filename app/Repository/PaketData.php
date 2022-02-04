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

    public function getAll($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->paketData->all();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->paketData->where('outlet_id', $outlet_id)->get();
        }
    }

    public function getAllDataGroupBy()
    {
        return $this->paketData->all()->groupBy('outlet_id');
    }

    public function getById($id)
    {
        return $this->paketData->find($id);
    }

    public function getByMonth($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->paketData->whereMonth('created_at', date('m'))->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->paketData->where('outlet_id', $outlet_id)->whereMonth('created_at', date('m'))->get();
        }
    }

    public function getByWeek($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->paketData->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->paketData->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->where('outlet_id',$outlet_id)->get();
        };
    }
}
