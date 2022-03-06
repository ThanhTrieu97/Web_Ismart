<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'cat_id',
        'parent_id',
    ];

    function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    function child()
    {
        return $this->hasMany(Product_cat::class, 'parent_id', 'id');
    }
    function cat()
    {
        return $this->hasMany(Product_type::class, 'cat_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    // public function childs() {
    //     return $this->hasMany(self::class,'parent_id','id');
    // }

    public function productss()
    {
        return $this->hasMany(Product::class);
    }

    public function childs()
    {
        return $this->hasMany('App\Model\Product_cat', 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Model\Product');
    }
}
