<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlnCustomer extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'table_pln_customer';
}
