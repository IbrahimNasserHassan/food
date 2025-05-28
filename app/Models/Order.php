<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //
        protected $fillable = [
            'customer_id',
            'total_amount',
            'payment_status',
            'invoice_number',
            'date',
        ];
    
        public function customer(): BelongsTo
        {
            return $this->belongsTo(Customer::class);
        }
    
        public function items(): HasMany
        {
            return $this->hasMany(OrderDetails::class);
        }
        public function orderDetails()
{
    return $this->hasMany(OrderDetails::class, 'order_id');
}
    
}
