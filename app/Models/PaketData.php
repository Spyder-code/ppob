<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketData extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'table_paket_data';

    public function paket()
    {
        return $this->belongsTo(Data::class, 'id_paket_data');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'id_provider');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'outlet_id');
    }
}
