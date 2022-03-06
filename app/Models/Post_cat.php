<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    function post (){
        return $this->belongsTo('App\Models\Post');
    }

    function child(){
        return $this->hasMany(Post_cat::class,'parent_id', 'id');
    }
}
