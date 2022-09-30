<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'image', 'content', 'slug', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}