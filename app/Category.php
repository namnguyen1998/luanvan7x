<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function SubCategory(){
    	return $this->hasMany(SubCategory::class);
    }

    public function Product(){
    	return $this->hasMany(Products::class);
    }
}
