<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class Customer extends Model
{
    protected $fillable = [
        
        'CustomerName','CustomerAddree','CustomerCity','CustomerPhone','CustomerEmail'
    ];
    protected $casts = [
        'CustomerPhone' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
