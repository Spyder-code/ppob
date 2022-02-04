<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'gender',
        'phone',
        'address',
        'avatar',
        'status',
        'saldo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function riwayat()
    {
        return $this->belongsTo('App\Models\RiwayatSaldo');
    }

    public function request_saldo()
    {
        return $this->belongsTo('App\Models\RequestSaldo');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class,'outlet_id');
    }

    public function pln()
    {
        return $this->hasMany(Pln::class, 'outlet_id');
    }

    public function pulsa()
    {
        return $this->hasMany(Pulsa::class, 'outlet_id');
    }

    public function paketData()
    {
        return $this->hasMany(PaketData::class, 'outlet_id');
    }

    public function plnByMonth()
    {
        return $this->pln()->whereMonth('created_at', date('m'));
    }

    public function pulsaByMonth()
    {
        return $this->pulsa()->whereMonth('created_at', date('m'));
    }

    public function paketDataByMonth()
    {
        return $this->paketData()->whereMonth('created_at', date('m'));
    }

    public function rewardByMonth()
    {
        return $this->reward()->whereMonth('created_at', date('m'));
    }

    public function pulsaByWeek()
    {
        // laravel where clause by week
        return $this->pulsa()->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ]);
    }

    public function plnByWeek()
    {
        // laravel where clause by week
        return $this->pln()->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ]);
    }

    public function paketDataByWeek()
    {
        // laravel where clause by week
        return $this->paketData()->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ]);
    }

    public function rewardByWeek()
    {
        // laravel where clause by week
        return $this->reward()->whereBetween('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek()
        ]);
    }
}
