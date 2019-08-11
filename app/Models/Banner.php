<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','link','status','image','added_by'];

    public function getRules(){
        return [
            'title' => 'required|string',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'image' => 'required|string',
        ];
    }
}
