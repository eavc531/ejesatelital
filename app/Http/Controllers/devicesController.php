<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\device;
use App\vehicle;
use App\deviceUninstalled;
use Auth;
class devicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function deviceChange($id)
     {
        /*$device = device::find($id);
       $vehicle = vehicle::find($device->vehicle_id);
        return view('vehicles.devices.edit')->with('vehicle', $vehicle)->with('device', $device);*/
     }

     public function deviceChangeStore(Request $request,$id)
     {
        /*$request->validate([
           'name'=> 'required',
           'sim'=> 'required|unique:devices',
           'imei'=> 'required|unique:devices',
        ]);*/

        $device = device::find($id);

        $deviceuninstalled = new deviceUninstalled;
        $deviceuninstalled->name = $device->name;
        $deviceuninstalled->sim = $device->sim ;
        $deviceuninstalled->imei = $device->imei;
        $vehicle = vehicle::find($device->vehicle_id);

        $deviceuninstalled->vehicle_id =  $vehicle->id;
        $deviceuninstalled->customer_id = $vehicle->customer_id;
        $deviceuninstalled->save();


        $device->fill($request->all());
        $device->vehicle_id = $vehicle->id;
        $device->save();

        return redirect()->route('devicesList',$vehicle->id)->with('success', 'El Dispositivo ha sido cambiado con Exito');
     }

     public function deviceCreate($id)
     {
        $vehicle = vehicle::find($id);

        $devices = device::where('vehicle_id',$id)->get();

        return view('vehicles.devices.create')->with('vehicle', $vehicle)->with('devices', $devices);
     }
     public function devicesList($id)
     {

        $vehicle = vehicle::find($id);
        $devicesUninstalled = deviceUninstalled::where('vehicle_id',$id)->orderBy('id','DESC')->get();

        $devices = device::where('vehicle_id',$id)->orderBy('id','DESC')->get();

         return view('vehicles.devices.devices')->with('vehicle', $vehicle)->with('devices',$devices)->with('devicesUninstalled', $devicesUninstalled);
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
          'name'=> 'required',
          'sim'=> 'required|unique:devices',
          'imei'=> 'required|unique:devices',
          'membership'=>'required'
       ]);

       $device = new device;
       $device->fill($request->all());
       $device->save();

       return redirect()->route('devicesList',$request->vehicle_id)->with('success', 'Dispositivo Agregado con Exito');

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
      if(Auth::user()->role != 'Administrador'){
         return back();
      }
      $device = device::find($id);
      $vehicle = vehicle::find($device->vehicle_id);

      return view('vehicles.devices.edit2')->with('vehicle', $vehicle)->with('device', $device);
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
      $device = device::find($id);
      $device->fill($request->all());
      $device->save();

       return redirect()->route('devicesList',$request->vehicle_id)->with('success', 'Dispositivo Editado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function deviceDestroy(Request $request)
    {
      $device = device::find($request->device_id);
      $vehicle = vehicle::find($device->vehicle_id);

      $dU = new deviceUninstalled;
      $dU->name = $device->name;
      $dU->sim = $device->sim;
      $dU->imei = $device->imei;
      $dU->vehicle_id = $device->vehicle_id;
      $dU->customer_id = $vehicle->customer_id;
      $dU->save();

      device::destroy($request->device_id);
      return back()->with('danger', 'Dispositivo Eliminado con Exito');
    }
}
