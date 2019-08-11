<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['user_id','product_id','rate','review','status'];
    public function users(){
        return $this->hasOne('App\User','id','user_id')->with('user_info');
    }
}
