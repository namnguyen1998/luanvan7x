<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "Order_Detail";

    public function Products(){
    	return $this->belongsTo(Products::class);
    }
    public function Orders(){
    	return $this->belongsTo(Orders::class);
    }
}
