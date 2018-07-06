<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function facture()
    {

    	return $this->belongsTo('App\Facture','f_id');
    }
     public function customer()
    {

    	return $this->belongsTo('App\Customer','customer_id');
    }
    public function zone()
    {

    	return $this->belongsTo('App\Zone','zone_id');
    }
    //  public function driver()
    // {

    // 	return $this->belongsTo('App\Driver','zone_id');
    // }
}
