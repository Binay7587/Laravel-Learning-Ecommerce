<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['cart_id','user_id','product_id','quantity','after_discount','total_amount','status'];
}
