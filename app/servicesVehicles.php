<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicesVehicles extends Model
{
   protected $fillable = [
      'services_id','vehicles_id','customers_id'
   ];

   public function services(){
      return $this->belongsTo('App\service');
   }

   public function vehicles(){
      return $this->belongsTo('App\vehicle');
   }
}
