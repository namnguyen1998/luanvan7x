<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OderDetail extends Model
{
    protected $table = "OderDetail"

    public function Product(){
    	return $this->belongsTo(Product::class);
    }
    public function Oder(){
    	return $this->belongsTo(Oder::class);
    }
}
