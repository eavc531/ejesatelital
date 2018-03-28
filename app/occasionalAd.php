<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class occasionalAd extends Model
{
   protected $fillable = [
'type','description','plate','payment','customer_id'
];
}
