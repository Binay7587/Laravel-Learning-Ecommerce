<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','slug','cat_id','child_cat_id','summary','description','price','discount','brand','is_featured','image','vendor_id','status'];

    public function category_info(){
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }
    public function child_category_info(){
        return $this->hasOne('App\Models\Category', 'id', 'child_cat_id');
    }
    public function vendor_info(){
        return $this->hasOne('App\User', 'id', 'vendor_id');
    }

    public function product_reviews(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('users')->where('status','active');
    }

    public function getAllProducts(){
        return $this->with(['category_info','child_category_info','vendor_info'])->orderBy('id','DESC')->get();
    }

    public function related(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit(9);
    }

    public function getProductBySlug($slug){

        return $this->with(['category_info','child_category_info','vendor_info','product_reviews','related'])->where('slug',$slug)->first();
    }
    public function getSlug($title){
        $slug = \Str::slug($title);
        $exists = $this->where('slug',$slug)->get();
        if($exists->count() > 0){
            $slug .= date('Ymdhis').rand(0,99);
        }
        return $slug;
    }

    public function getRules(){
        return [
            'title' => 'required|string',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:100',
            'discount' => 'nullable|numeric|min:0|max:90',
            'brand' => 'nullable|string',
            'is_featured' => 'sometimes|in:1',
            'image' => 'required|string',
            'vendor_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ];
    }
}
