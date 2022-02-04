<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulsa extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'table_pulsa';

    public function nominal()
    {
        return $this->belongsTo(Nominal::class, 'id_nominal');
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
