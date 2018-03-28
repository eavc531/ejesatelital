<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicesAds extends Model
{
   protected $fillable = [
'type','description','plate','payment','customer_id','user_id'
];
   public function user(){
      return $this->belongsTo('App\User');
   }
   public function customer(){
      return $this->belongsTo('App\customer');
   }
}
