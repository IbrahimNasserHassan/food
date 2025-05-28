<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name','category_id','supplier_id','quantity', 'purchase_price', 'retail_price', 'wholesale_price','allows_retail','units_per_wholesale'
];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

      public function items()
    {
        return $this->hasMany(OrderDetails::class);
    }



}


