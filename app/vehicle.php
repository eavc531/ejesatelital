<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
   protected $fillable = [
   'name','plate','year','description','customer_id'
];
   public function customer(){
      return $this->belongsTo('App\customer');
   }

   //no sta funcional
   public function servicesVehicles(){
      return $this->hasMany('App\servicesVehicles','id','vehicles_id');

   //fin
   }


}
