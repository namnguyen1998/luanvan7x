<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = "Customers";
    protected $primaryKey = 'id_customer';


    public function Oders(){
    	return $this->hasMany(Oders::class);
    }
}
