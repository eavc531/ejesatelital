<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\customer;
use App\servicesVehicles;
use App\servicesads;
class pdfController extends Controller
{
    public function pdf(){
      $customer = customer::find(1);

      $servicev = servicesVehicles::where('customers_id','=',1)->get();

      $servicesads = servicesads::where('customer_id','=' ,1)->get();

      $pdf = PDF::loadView('pdf.pdf',['customer'=>$customer,'$servicev'=>$servicev,'$servicesads'=>$customer]);

      return $pdf->download('invoice.pdf');

      return back()->with('success','generado');
   }
}
