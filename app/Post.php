<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','body','tag'];
    // protected static function boot(){
    //     parent::boot();
    //     static::creating(function ($model){
    //         d
    //     });
    // }
}
