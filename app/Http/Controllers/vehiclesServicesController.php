<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vehicle;
use App\service;
use App\servicesVehicles;
use App\customer;
use Illuminate\Validation\Rule;
use App\invoice;
use App\invoice_number;
use Auth;
use Carbon\Carbon;


class vehiclesServicesController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
 public function index()
 {
     //
 }

 /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function addService($id)
   {

      $vehicle = vehicle::find($id);
      $serviceslist = service::pluck('name','id');
      $serviceVehicle = servicesVehicles::where('vehicles_id',$id)->get();

       return view('vehicles.vehicleServices')->with('vehicle', $vehicle)->with('serviceVehicle', $serviceVehicle)->with('serviceslist', $serviceslist);
   }



   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
 public function create()
 {
     //
 }

 /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
 public function store(Request $request)
 {
    $request->validate([
      'services_id' => [
         'required',Rule::unique('services_vehicles')->where('vehicles_id',$request->vehicles_id)
      ]
   ]);

   $sv = new servicesVehicles;
   $sv->fill($request->all());
   $sv->save();

   $vehicle = vehicle::find($request->vehicles_id);

    return redirect()->route('addService',$request->vehicles_id)->with('success', 'Servicio Agregado Con Exito.');

    /*$invoiceNumber = invoice_number::where('customer_id','=',$vehicle->customer_id)->get()->last();

    $customer = customer::find($vehicle->customer_id);
    $service = service::find($request->services_id);

    $invoice = new invoice;
    $invoice->fill($request->all());
    $invoice->invoiceNumber = $invoiceNumber->invoiceNumber;
    $invoice->customer_id = $customer->id;
    $invoice->service = $service->name;
    $invoice->plate = $vehicle->plate;
    $invoice->payment = $service->payment;
    $invoice->idNumberCustomer = $customer->idNumber;
    $invoice->nameCustomer = $customer->name;
    $invoice->vehicle =  $vehicle->name;
    $invoice->nameSeller = Auth::user()->name;
    $invoice->registered = Auth::user()->name;
    $invoice->save();*/
 }

 /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
 public function show($id)
 {
     //
 }

 /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
 public function edit($id)
 {
     //
 }

 /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
 public function update(Request $request, $id)
 {
     //
 }

 /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
 public function destroy($id)
 {
     //
 }


}
