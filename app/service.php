<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
   protected $fillable = [
  'name','description','payment'
];
    protected $dates = ['deleted_at'];
}
