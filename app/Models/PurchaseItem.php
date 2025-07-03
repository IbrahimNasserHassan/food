<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    //

    use HasFactory;

    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'purchase_price', 'subtotal'];

    public function invoice()
    {
        return $this->belongsTo(Purchase::class, 'purchase_invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
