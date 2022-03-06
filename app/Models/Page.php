<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'content',
        'thumbnail',
        'status',
        'user_id'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }
}
