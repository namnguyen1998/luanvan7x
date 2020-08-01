<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $products = "Products";
    protected $primaryKey = 'id_product';

    public function Category(){
    	return $this->belongsTo(Category::class);
    }
    public function SubCategory(){
    	return $this->belongsTo(SubCategory::class);
    }
    public function Brand(){
    	return $this->belongsTo(Brand::class);
    }
    public function OderDetail(){
    	return $this->hasMany(OrderDetail::class);
    }
    public function Users(){
        return $this->hasMany(Products::class);
    }
}   
