<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\vehicle;
use App\servicesVehicles;
use App\servicesAds;
use App\service;
use Auth;
use App\invoiceDetail;
use App\invoice_number;
use App\invoice;
use App\user;
use Mail;
use App\document;
use App\deviceUninstalled;
use App\device;
use App\notification;

use Carbon\Carbon;
class customersController extends Controller
{

      public function enableUser($id)
      {
         $customer = customer::find($id);
         $customer->stateUser = 'Habilitado';
         $customer->save();
         return redirect()->route('customersDetails',$id)->with('customer',$customer)->with('success','El Usuario: '. $customer->name.' ha sido Habilitado');
      }
      public function disabled($id)
      {
         $customer = customer::find($id);
         $customer->stateUser = 'Deshabilitado';
         $customer->save();
         return redirect()->route('customers.edit',$id)->with('customer',$customer)->with('danger','El Usuario: '. $customer->name.' ha sido deshabilitado');
      }

      public function sendSms($id)
      {
         $customer = customer::find($id);
         return view('customers.sms')->with('customer',$customer);
      }

      public function storeVehicles(Request $request)
      {

         $request->validate([
            'name' => 'required',
            'plate' => 'required'
         ]);
         $vehicle =  new vehicle;
         $vehicle->fill($request->all());
         $vehicle->save();

         return redirect()->route('customersVehicles',$request->customer_id);
      }


      public function CreateVehicles($id)
      {

         $customer = customer::find($id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }
         return view('vehicles.create')->with('customer', $customer);
      }

      public function customersVehicles($id)
      {

         $customer = customer::find($id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }
         $vehicles = vehicle::where('customer_id', '=',$id)->get();
         return view('vehicles.vehicles')->with('customer', $customer)->with('vehicles', $vehicles);
      }

      public function customerdetails($id)
      {
         $customer = customer::find($id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }

         $invoices = invoice::where('customer_id', '=',$id)->where('statePayment', 'Pendiente')->orderBy('id','desc')->get();
         $invoicesCount = invoice::where('customer_id', '=',$id)->where('statePayment', 'Pendiente')->count();

         $vehicles = vehicle::where('customer_id', '=',$id)->get();
         $vehiclesCount = vehicle::where('customer_id', '=',$id)->count();
         $services_vehicles = servicesVehicles::where('customers_id', $id)->get();
         $services_vehiclesCount = servicesVehicles::where('customers_id', $id)->count();

         if(Auth::user()->role != 'Cliente'){
            return view('customers.details')->with('customer', $customer)->with('vehicles', $vehicles)->with('services_vehicles', $services_vehicles)->with('vehiclesCount',$vehiclesCount)->with('services_vehiclesCount',$services_vehiclesCount)->with('invoices', $invoices)->with('invoicesCount', $invoicesCount);
         }

         return view('customers.details2')->with('customer', $customer)->with('vehicles', $vehicles)->with('services_vehicles', $services_vehicles)->with('vehiclesCount',$vehiclesCount)->with('services_vehiclesCount',$services_vehiclesCount)->with('invoices', $invoices)->with('invoicesCount', $invoicesCount);

      }

      public function customerServices($id)
      {
         //aqui///////////////////////////////////////////////////////////////////////////////
         $customer = customer::find($id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }

         $invoiceCount = invoice::where('customer_id', $id)->where('type', 'Recurrente')->count();
         if($invoiceCount != 0){

            $invoiceL = invoice::where('customer_id', $id)->where('type', 'Recurrente')->orderBy('id','desc')->first();

            $dateIni = $invoiceLatest = \Carbon\Carbon::parse($invoiceL->paymentTimely)->startOfMonth();
         }else{
            $dateIni = Carbon::today();
         }

         //$periodInvocice = '26-'.$today->format('m-Y');
         $servicesads = servicesAds::where('customer_id', $id)->get();
         //$ve = vehicle::where('customer_id',$id)->get();
         $sv = servicesVehicles::where('customers_id',$id)->get();

         return view('customers.services')->with('sv', $sv)->with('customer', $customer)->with('servicesads', $servicesads)->with('dateIni', $dateIni);
      }

      public function deleteSA($id)
      {
         servicesAds::destroy($id);
         return redirect()->back()->with('danger','Servicio Borrado Con Exito');
      }
      public function additionalServices($id)
      {
         //$servicesads = servicesAds::where('customer_id', '=', $id)->get();
         $customer = customer::find($id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }
         $vehicle = vehicle::where('customer_id',$id)->pluck('plate','plate');

         return view('services.additionalServices')->with('customer_id',$id)->with('vehicle', $vehicle);
      }

      public function additionalServicesStore(Request $request)
      {

         $request->validate([
            'type'=>'required',
            'payment'=>'required',
            'description'=>'required',
         ]);

         $customer = customer::find($request->customer_id);
         if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
            return redirect()->back()->with('danger', 'No tienes Permisos');
         }
         $sa = new servicesAds;
         $sa->fill($request->all());
         $sa->user_id = Auth::user()->id;
         $sa->save();

         if ($request->typeService == 'Adicional'){
            return redirect()->route('customersServices',$request->customer_id)->with('success', 'Servicio Añadido con Exito.');
         }else{
            return redirect()->route('customersServices',$request->customer_id)->with('success', 'Descuento Añadido con Exito.');
         }

         /*$invoiceNumber = invoice_number::where('customer_id','=',$request->customer_id)->get()->last();
         $invoice = new invoice;

         $customer = customer::find($request->customer_id);

         $invoice->fill($request->all());
         $invoice->invoiceNumber = $invoiceNumber->invoiceNumber;
         $invoice->idNumberCustomer = $customer->idNumber;
         $invoice->nameCustomer = $customer->name;
         $invoice->nameSeller = Auth::user()->name;
         $invoice->save();*/

      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function Confirm($var)
    {
      if(Auth::user()->role == 'Administrador'){
         $customers = customer::SearchConfirm('Pago Confirmado')->orderBy('id','desc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', 'Administrador')->count();

      }else{
         $customers = customer::SearchConfirm2('Pago Confirmado')->orderBy('id','desc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->count();

      }

      return view('customers.index')->with('customers',$customers)->with('notifications', $notifications);


    }

     public function Pending($variable)
    {
      if(Auth::user()->role == 'Administrador'){
         $customers = customer::SearchPending('Enviada/Pendiente')->orderBy('id','desc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', 'Administrador')->count();
      }else{
         $customers = customer::SearchPending2('Enviada/Pendiente')->orderBy('id','desc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->count();
      }

      return view('customers.index')->with('customers',$customers)->with('notifications',$notifications );
    }

    public function  customerSearch(Request $request)
    {


      if($request->select == 'cedula'){
         if(Auth::user()->role == 'Administrador'){
            $customers = customer::SearchIdNumber($request->variable)->orderBy('idNumber','desc')->paginate(10);
               $notifications = notification::where('validate','no')->where('for', 'Administrador')->count();
         }else{
            $customers = customer::SearchIdNumber2($request->variable)->orderBy('idNumber','desc')->paginate(10);
            $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->count();
         }
      }else{
         if(Auth::user()->role == 'Administrador'){
               $notifications = notification::where('validate','no')->where('for', 'Administrador')->count();
           $customers = customer::searchName($request->variable)->orderBy('idNumber','desc')->paginate(10);
         }else{
           $customers = customer::searchName2($request->variable)->orderBy('idNumber','desc')->paginate(10);
           $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->count();
         }
      }
           return view('customers.index')->with('customers', $customers)->with('notifications', $notifications);
      }

      public function customerDisabled(Request $request)
      {
        $mostrar = 'mostrar';
        if(Auth::user()->role == 'Administrador'){
            $customers = customer::SearchDisabled('Deshabilitado')->orderBy('id','desc')->paginate(10);
            return view('customers.customersDisabled')->with('customers',$customers);
        }else{
            $customers = customer::SearchDisabled2('Deshabilitado')->orderBy('id','desc')->paginate(10);
            return view('customers.customersDisabled')->with('customers',$customers)->with('mostrar',$mostrar);
        }

      }

    public function index(Request $request)
    {

      if (Auth::user()->role == 'Administrador') {
         $customers = customer::whereNull('stateUser')->orWhere('stateUser','Habilitado')->orderBy('idNumber','asc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', 'Administrador')->count();
      }else{
         $customers = customer::where('stateUser','Habilitado')->where('seller_id',Auth::user()->id)->orderBy('idNumber','desc')->paginate(10);
         $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->count();
      }

        return view('customers.index')->with('customers', $customers)->with('notifications', $notifications);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function customerCreate()
      {

          return view('customers.create');
      }

     public function create()
     {

         //return view('customers.create');
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
          'idNumber'=>'required|unique:customers','name'=>'required','address'=>'required','phone1'=>'numeric|required','phone2'=>'numeric|nullable','email'=>'email|unique:customers|unique:users|required','email2'=>'email|nullable','city'=>'required','password'=>'required'
      ]);
      $customer =  new customer;
      $customer->fill($request->all());
      $customer->addFor = Auth::user()->name;
      $customer->save();
      $lastcustomer = customer::all()->last();



      $user = new user;
      $user->fill($request->all());
      $user->password = bcrypt($request->password);
      $user->role = 'Cliente';
      $user->customer_id = $lastcustomer->id;

      $user->save();

      $lastuser = customer::all()->last();


         if(Auth::user()->role != 'Administrador'){
            Mail::send('mail.notificationAddCustomer',['request'=>$request], function($msj) use($request){
              $msj->subject('Notificacion: Nuevo Usuario Agregado');
              $msj->to('testprogramas531@gmail.com');
            });

               $notification = new notification;
               $notification->notification = 'Nuevo Usuario Agregado';
               $notification->execute = 'El usuario: "'.Auth::user()->name.'" a Agregado un Nuevo Cliente con el Nombre de: "'.$customer->name.'"';
               $notification->validate = 'no';
               $notification->extra = Auth::user()->name;
               $notification->customer_id =  $lastcustomer->id;
               $notification->seller_id = $request->seller_id;
               $notification->for = 'Administrador';
               $notification->save();

         }




      return redirect()->route('customers.index')->with('success', 'Cliente Agregado Correctamente');
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
      $customer = customer::find($id);
      if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
         return redirect()->back()->with('danger', 'No tienes Permisos');
      }
        return view('customers.edit')->with('customer',$customer);
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
      if(auth::user()->role != 'Administrador'){
         return back();
      }
      $customer = customer::find($id);
      $customer1 = customer::find($id);

      if($request->email == $customer->email){
         $request->validate([
         'name'=>'required','address'=>'required','phone1'=>'numeric|required','phone2'=>'numeric','email'=>'email|required','city'=>'required'
         ]);
      }else{
         $request->validate([
             'name'=>'required','address'=>'required','phone1'=>'numeric|required','phone2'=>'numeric','email'=>'email|unique:customers|unique:users|required','city'=>'required'
         ]);

      }


      $customer->fill($request->all());

      if($request->password == null){
         $customer->password = $customer1->password;
      }else{
         $customer->password = $request->password;
      }

      $customer->save();

      $user = User::where('customer_id',$customer1->id)->first();

      $user->name = $request->name;
      $user->email =  $request->email;
      $user->password = bcrypt($request->password);
      $user->role = 'Cliente';
      $user->customer_id = $customer->id;
      $user->save();


      return redirect()->route('customersDetails',$customer->id)->with('success', 'Los Datos del Cliente han sido Guardados Con Exito');

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

    public function vehicleDestroy($id)
    {

      $SV = servicesVehicles::where('vehicles_id',$id)->count();
      $devices = device::where('vehicle_id',$id)->count();

      if($SV > 0 or $devices > 0){
          return back()->with('warning','Imposible borrar Vehiculo, Contiene: "'.$SV.'" Servicios y "'.$devices.'" Dispositivos  Registrados');
      }else{
         $dvc = deviceUninstalled::where('vehicle_id',$id);
         $dvc->delete();
          vehicle::Destroy($id);
           return back()->with('danger','Vehiculo Eliminado con Exito');
      }

    }
}
