<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messagesConfirm extends Model
{
   protected $fillable = [
  'medioPayment','dateConfirmPayment','Banco','nroReferencia','mensaje','invoice_id','invoiceperiod'
];

}
