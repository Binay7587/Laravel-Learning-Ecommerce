<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'slug', 'is_parent', 'parent_id', 'summary', 'image', 'status', 'added_by'];

    public function getAddRules($act = 'add')
    {
        $rules = [
            'title' => 'required|string|unique:categories,title',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'summary' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ];

        if($act != 'add'){
            $rules['title'] = "required|string";
        }
        return $rules;
    }

    public function getAllParents()
    {
        return $this->where('is_parent', 1)->orderBy('title', 'ASC')->pluck('title', 'id');
    }

    public function parent_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function getAllCategories()
    {
        return $this->with('parent_info')->get();
    }

    public function child_categories(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }

    public function getParents(){
        return $this->where('status','active')->where('is_parent',1)->with('child_categories')->orderBy('title','ASC')->get();
    }

    public function getSlug($title)
    {
        // this is title => this-is-title

        $slug = \Str::slug($title);
        if ($this->where('slug', $slug)->count() > 0) {
            $slug .= rand(0, 999);
        }

        return $slug;
    }
    public function category_products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }
    public function sub_category_products(){
        return $this->hasMany('App\Models\Product','child_cat_id','id')->where('status','active');
    }

    public function getCategoryBySlug($slug){
        return $this->with('category_products')->where('slug',$slug)->first();
    }

    public function  getSubCategoryBySlug($sub_slug){
        return $this->with('sub_category_products')->where('slug',$sub_slug)->first();
    }
    public function shiftChild($child_id)
    {
        return $this->whereIn('id',$child_id)->update(['is_parent'=>1]);
        // update categories SET is_parent = 1 WHERE id IN (4,5,6,7)
    }
}
