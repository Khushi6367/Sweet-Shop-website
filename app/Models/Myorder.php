<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Myorder extends Model
{
    //
    protected $fillable = ['finalprice', 'mrp', 'price', 'discount', 'madewith', 'weight_type', 'weight', 'qty', 'flavour', 'product_name', 'address', 'mobile', 'name', 'user_id', 'product_id', 'billno_id', 'payment_method', 'utr', 'screenshot'];
    public function product()
    {
        return  $this->belongsTo(Product::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
