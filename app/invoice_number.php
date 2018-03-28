<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_number extends Model
{
   protected $fillable = [
   'invoiceNumber','customer_id',
   ];
}
