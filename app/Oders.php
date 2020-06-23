<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    protected $table = "Oders";

    public function Oder(){
    	return $this->hasMany(Oder::class);
    }
    public function Customer(){
    	return $this->belongsTo(Customer::class);
    }
    public function Payment(){
    	return $this->belongsTo(Payment::class);
    }
    public function Users(){
        return $this->belongsTo(Users::class);
    }
}
