<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "Orders";

    public function Oder(){
    	return $this->hasMany(Orders::class);
    }
    public function Customer(){
    	return $this->belongsTo(Customers::class);
    }
    public function Payment(){
    	return $this->belongsTo(Payment::class);
    }
    public function Users(){
        return $this->belongsTo(Users::class);
    }
}
