<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{

    public function posts(){
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }

    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
