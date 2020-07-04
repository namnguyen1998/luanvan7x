<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = "shipping_address";
    
    public function Customers(){
    	return $this->hasOne(Customers::class);
    }
}
