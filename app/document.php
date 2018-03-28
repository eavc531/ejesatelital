<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
   protected $fillable = [
     'name','path','customer_id'
  ];

}
