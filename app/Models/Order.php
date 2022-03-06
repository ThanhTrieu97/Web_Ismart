<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'code',
        'customer',
        'phone_number',
        'email',
        'product_id',
        'image_id',
        'number_order',
        'total',
        'province',
        'district',
        'ward',
        'way',
        'status',
        'note',
    ];

    function order_cat_id (){
        return $this->belongsTo(Product::class, 'product_id');
        // return $this->belongsTo('App\Models\Product_cat');
    }
    function order_image_id (){
        return $this->belongsTo(Product::class, 'image_id');
        // return $this->belongsTo('App\Models\Product_cat');
    }

    function address_id (){
        return $this->belongsTo(Location::class,  'province', 'district','ward','way');
        //
    }
}
