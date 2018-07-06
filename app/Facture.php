<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    public function customer()
    {

    	return $this->belongsTo('App\Customer');
    }
    public function detail()
    {

    	return $this->hasMany('App\Detail','f_id');
    }
     public function zone()
    {

    	return $this->belongsTo('App\Zone');
    }
}
