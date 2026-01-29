<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $primaryKey = ['user_id', 'user_id'];
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'user_id',
    ];

}
