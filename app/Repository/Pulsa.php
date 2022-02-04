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

    public function getAll($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pulsa->all();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pulsa->where('outlet_id', $outlet_id)->get();
        }
    }

    public function getAllDataGroupBy()
    {
        return $this->pulsa->all()->groupBy('outlet_id');
    }

    public function getById($id)
    {
        return $this->pulsa->find($id);
    }

    public function getByMonth($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pulsa->whereMonth('created_at', date('m'))->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pulsa->where('outlet_id', $outlet_id)->whereMonth('created_at', date('m'))->get();
        }
    }

    public function getByWeek($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pulsa->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pulsa->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->where('outlet_id', $outlet_id)->get();
        };
    }
}
