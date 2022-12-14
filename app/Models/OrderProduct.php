<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'orders_id',
        'product_price',
        'product_name',
        'amount',
        'value'
    ];
}
