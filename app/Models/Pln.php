<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pln extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'table_pln';

    public function customer()
    {
        return $this->belongsTo(PlnCustomer::class, 'id_customer');
    }

    public function paket()
    {
        return $this->belongsTo(NominalPln::class, 'id_paket_pln');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'outlet_id');
    }
}
