<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'price_old',
        'product_desc',
        'product_detail',
        'product_cat',
        'thumbnail',
        'user_id',
        'cat_id',
        'status',
        'selling_products'
    ];

    function product_cat_id (){
        return $this->belongsTo(Product_cat::class, 'product_cat');

    }

    function product_type_id (){
        return $this->belongsTo(Product_type::class, 'cat_id');
    }

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function categories() {
        return $this->belongsTo(Product_cat::class, 'id');
    }
}
