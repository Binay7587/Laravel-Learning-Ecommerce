<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cart_id','user_id','sub_total','delivery_charge','total_amount','status'];
}
