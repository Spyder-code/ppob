<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'reward',
    ];

    public function outlet()
    {
        return $this->belongsTo(User::class, 'outlet_id');
    }
}
