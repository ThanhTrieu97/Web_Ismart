<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'title',
        'post_desc',
        'content',
        'page_id',
        'post_id',
        'thumbnail',
        'status',
    ];

    function post_cat_id (){
        return $this->belongsTo(Post_cat::class, 'post_id');
        // return $this->belongsTo('App\Models\Product_cat');
    }

    function page(){
        return $this->belongsTo('App\Models\Page');
    }

    function post_cat(){
        return $this->belongsTo('App\Models\Post_cat');
    }
}
