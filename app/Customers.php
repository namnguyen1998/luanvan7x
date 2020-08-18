<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = "customers";
    protected $primaryKey = 'id_customer';


    public function Oders(){
    	return $this->hasMany(Orders::class);
    }
}
