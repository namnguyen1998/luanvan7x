<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_detail";

    public function Products(){
    	return $this->belongsTo(Products::class);
    }
    public function Orders(){
    	return $this->belongsTo(Orders::class);
    }
}
