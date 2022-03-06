<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product_image extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'product_id',
    ];

    function product_image_id (){
        return $this->belongsTo(Product::class, 'product_id');
        // return $this->belongsTo('App\Models\Product_cat');
    }
}
