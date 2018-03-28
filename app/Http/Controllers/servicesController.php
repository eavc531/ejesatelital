<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\vehicle;
use App\servicesVehicles;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $services = service::orderBy('id','desc')->paginate(10);
        return view('services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
          'name' => 'required|unique:services',
          'payment' => 'required|numeric'
      ]);
        $service = new service;
        $service->fill($request->all());
        $service->save();

        return redirect()->route('services.index')->with('success','Servicio Aregado Correctamente');

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

      $services = service::find($id);
        return view('services.edit')->with('services', $services);
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
      $service = service::find($id);
      if($request->name == $service->name){
         $request->validate([
             'name' => 'required',
             'payment' => 'required'
         ]);
      }else {
         $request->validate([
             'name' => 'required|unique:services',
             'payment' => 'required'
         ]);
      }


      $service->fill($request->all());
      $service->save();

      return redirect()->route('services.index')->with('success', 'Servicio Editado Con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $service = service::find($id);
      $SV = servicesVehicles::where('services_id',$id)->count();
      if($SV == 0){
          service::destroy($id);
          return redirect()->back()->with('danger', 'Servicio Eliminado con Exito.');
      }else{
          return redirect()->back()->with('warning', 'Imposible Eliminar el Servicio: "'.$service->name.'". Ahi '.$SV. 'vehiculo(s) registrado(s) con este Servicio.');
      }




    }

    public function serviceVDestroy(Request $request)
    {

        $SV = servicesVehicles::where('services_id', $request->service_id)->where('vehicles_id',$request->vehicle_id);
        $SV->delete();



        return redirect()->back()->with('success', 'Servicio Eliminado con Exito');
    }

}
