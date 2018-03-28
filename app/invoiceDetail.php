<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceDetail extends Model
{
   protected $fillable = [
    'invoice_id','vehicle','plate','type','description','payment',
   ];

   public function invoice(){
      return $this->hasMany('App\invoice');
   }
}
