<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deviceUninstalled extends Model
{
   protected $fillable = [
     'name','sim','imei','vehicle_id','customer_id'
 ];

}
