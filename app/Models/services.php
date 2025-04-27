<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $fillable = [
        'Service_type',
        'company',
        'requirment',
        'Service_price',
        'date'
    ];

}
