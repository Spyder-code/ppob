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

    public function getAll($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pln->all();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pln->where('outlet_id', $outlet_id)->get();
        }
    }

    public function getAllDataGroupBy()
    {
        return $this->pln->all()->groupBy('outlet_id');
    }

    public function getById($id)
    {
        return $this->pln->find($id);
    }

    public function getByMonth($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pln->whereMonth('created_at', date('m'))->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pln->where('outlet_id', $outlet_id)->whereMonth('created_at', date('m'))->get();
        }
    }

    public function getByWeek($id = 0)
    {
        if((Auth::user()->role == 'operator' || Auth::user()->role == 'admin') && $id == 0){
            return $this->pln->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->get();
        }else{
            $outlet_id = $id != 0 ? $id : Auth::id();
            return $this->pln->whereBetween('created_at', [
                \Carbon\Carbon::now()->startOfWeek(),
                \Carbon\Carbon::now()->endOfWeek()
            ])->where('outlet_id', $outlet_id)->get();
        };
    }
}
