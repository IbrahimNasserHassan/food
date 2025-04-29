<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    
    protected $fillable = [
        'supplier_name',
        'supplier_phone',
        'supplier_address'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    


}
