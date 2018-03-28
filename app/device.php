<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
   protected $fillable = [
     'name','sim','imei','membership','vehicle_id'
 ];

}
