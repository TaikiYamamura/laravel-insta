<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = ['follower_id', 'following_id'];
    public $incrementing = false;
    
    public $timestamps = false;

    // Mass Assignment 対応
    protected $fillable = [
        'following_id',
        'follower_id',
    ];

    #to get the information of a follower
    public function follower(){
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }

    #to get the information of the user being followed
    public function following(){
        return $this->belongsTo(User::class, 'following_id')->withTrashed();
    }

}
