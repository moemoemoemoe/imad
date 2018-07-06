<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Customer extends Model
{
    public function facture()
    {

    	return $this->hasMany('App\Facture');
    }

     public function rate()
    {

    	return $this->hasMany('App\Shipping','customer_id');
    }
}
