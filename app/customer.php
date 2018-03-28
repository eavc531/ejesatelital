<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
   protected $fillable = [
     'idNumber','name','address','phone1','phone2','email','email2','rol','seller_id','city','password',
 ];

   protected $hidden = [
    'password'
    ];

    public function scopesearchIdNumber($query, $idNumber){
      return $query->where('idNumber','LIKE','%'.$idNumber.'%');
   }

   public function scopesearchIdNumber2($query, $idNumber){
      return $query->where('seller_id',Auth::user()->id)->where('idNumber','LIKE','%'.$idNumber.'%');
  }

  public function scopesearchName($query, $name){
    return $query->where('name','LIKE','%'.$name.'%');
 }

 public function scopesearchName2($query, $name){
    return $query->where('seller_id',Auth::user()->id)->where('name','LIKE','%'.$name.'%');
}

   public function scopeSearchPending($query, $variable){
      return $query->where('statePayment','!=','Pago Confirmado')->where('stateUser', 'Habilitado');
   }

   public function scopeSearchPending2($query, $variable){
     return $query->where('seller_id',Auth::user()->id)->where('statePayment','!=','Pago Confirmado');

      $query->where('seller_id',Auth::user()->id)->where('statePayment',$variable)->Where('statePayment','Sin Enviar');
   }

   public function scopeSearchConfirm($query, $variable){
     return $query->where('statePayment','Pago Realizado');
   }

   public function scopeSearchConfirm2($query, $variable){
     return $query->where('seller_id',Auth::user()->id)->where('statePayment','Pago Realizado');
   }

   public function scopeSearchDisabled($query, $variable){
     return $query->where('stateUser','Deshabilitado');
   }

   public function scopeSearchDisabled2($query, $variable){
     return $query->where('seller_id',Auth::user()->id)->where('stateUser','Deshabilitado');
   }

   public function seller(){
      return $this->belongsTo('App\User');
   }

   public function invoice(){
      return $this->belongsTo('App\invoice');
   }

}
