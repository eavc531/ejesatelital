<?php

namespace App\Http\Controllers;
use PDF;
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
use Carbon\Carbon;
use Mail;
use App\messagesConfirm;
use App\occasionalAd;
class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function invoiceOccasionalDetails($id){
        $invoice1 = invoice::where('id', $id)->first();
        $customer = customer::find($invoice1->customer_id);

      if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
         return redirect()->back()->with('danger', 'No tienes Permisos');
        }
       $invoiceDetails = invoiceDetail::where('invoiceNumber',$invoice1->invoiceNumber)->get();

       $invoices = invoice::where('id', $id)->first();

       $mConfirm = messagesConfirm::where('invoice_id',$id)->first();

        return view('invoice.invoiceOccasionalDetails')->with('invoices', $invoices)->with('invoiceDetails', $invoiceDetails)->with('mConfirm',$mConfirm)->with('customer',$customer);

     }

     public function cancelCreateInvoice(){

        $invoice = invoice::all()->last();
        $invoice->delete();
        $invoiceDetail = invoiceDetail::where('invoiceNumber',$invoice->invoiceNumber)->delete();
        return back();

     }
     public function confirmCreateInvoice(){
        $invoice = invoice::all()->last();

       $servicesAds = servicesAds::where('customer_id',$invoice->customer_id)->delete();

       return redirect()->route('invoiceDetails',$invoice->id);

     }
     public function addDetailInvoice($id){
        $invoice = invoice::find($id);
        $vehicle = vehicle::where('customer_id', $invoice->customer_id)->pluck('plate','plate');
        return view('invoice.addDetailInvoice')->with('invoice', $invoice)->with('vehicle', $vehicle);

     }

      public function addDetailInvoiceStore(Request $request){
         $request->validate([
            'type' => 'required',
            'description' => 'required',
            'payment' => 'required|integer',
         ]);
         $invoice = invoice::find($request->id);

         if($request->type == 'Adicional'){
            $invoice->total = $invoice->total + $request->payment;
         }else{
            $invoice->total = $invoice->total - $request->payment;
         }
         $invoice->save();

         $invoiceDetail = new invoiceDetail;
         $invoiceDetail->invoiceNumber  = $invoice->invoiceNumber;
         $invoiceDetail->vehicle  = 'null';
         $invoiceDetail->plate = $request->plate;
         $invoiceDetail->type = $request->type;
         $invoiceDetail->description = $request->description;
         $invoiceDetail->payment = $request->payment;
         $invoiceDetail->save();

         return redirect()->route('invoiceDetails',$invoice->id)->with('success','Detalle Agregado con Exito');
      }

     public function deleteDF($id){
        $invoiceD = invoiceDetail::find($id);
        $invoice = invoice::where('invoiceNumber',$invoiceD->invoiceNumber)->first();
        if($invoiceD->type == 'Adicional'){
           $invoice->total = $invoice->total - $invoiceD->payment;
           $invoice->save();
        }elseif($invoiceD->type == 'Descuento'){
           $invoice->total = $invoice->total + $invoiceD->payment;
           $invoice->save();
        }

        $invoiceD->delete();

        return back()->with('danger', 'Se a Eliminado Una Fila de la Factura');

     }

     public function invoiceOccasional($id){
        $customer = customer::find($id);
        $occasionalAd = occasionalAd::where('customer_id',$id)->get();
        $vehicle = vehicle::where('customer_id',$id)->pluck('plate','plate');

        return view('invoice.invoiceOccasional')->with('customer',$customer)->with('occasionalAd', $occasionalAd)->with('vehicle', $vehicle);
     }

     public function invoiceOccasionalAd(Request $request, $id){
        $request->validate([
           'description'=>'required',
           'payment'=>'required|integer',

        ]);

        $occasionalAd = new occasionalAd;
        $occasionalAd->fill($request->all());
        $occasionalAd->customer_id = $id;
        $occasionalAd->save();

        return back()->with('success', 'Monto Agregado Con Exito');
     }

      public function deleteAO($id){
         occasionalAd::destroy($id);

         return back()->with('danger', 'Servicio Eliminado de la Factura');

      }

      public function invoiceOccasionalStore(Request $request){
         $customer = customer::find($request->customer_id);

         //$invoice_number = invoice::where('customer_id', $request->customer_id)->count();
         $invoice_number = invoice::all()->count();

         $invoiceNumber = $invoice_number + 1;

         $number = invoice::where('customer_id',$request->customer_id)->count();
         $number = $number + 1;



         $invoice = new invoice;
         $invoice->invoiceNumber = $invoiceNumber;
         $invoice->number = $number;
         $invoice->dateIni = $request->dateIni;
         $invoice->invoiceperiod = 'Factura Occasional';
         $invoice->paymentTimely = $request->paymentTimely;
         $invoice->Customer_id = $customer->id;
         $invoice->idNumberCustomer = $customer->idNumber;
         $invoice->nameCustomer = $customer->name;
         $invoice->nameSeller = $customer->seller->name;
         $invoice->registered =  Auth::user()->name;
         $invoice->total = $request->total;
         $invoice->save();

         $occasionalAd = occasionalAd::where('customer_id',$request->customer_id);

         $occasionalAd = $occasionalAd->each(function ($OA, $key) use($invoiceNumber){

             $invoiceDetails = new invoiceDetail;
             $invoiceDetails->invoiceNumber = $invoiceNumber;
             $invoiceDetails->vehicle = 'null';
             $invoiceDetails->plate = $OA->plate;
             $invoiceDetails->type = $OA->type;
             $invoiceDetails->description = $OA->description;
             $invoiceDetails->payment = $OA->payment;
             $invoiceDetails->save();
         });

         $occasionalAd = occasionalAd::where('customer_id',$request->customer_id)->delete();

         $customer = customer::find($request->customer_id);

            $invoceMenor = invoice::where('customer_id',$request->customer_id)->where('statePayment','Pendiente')->orderBy('paymentTimely','asc')->first();

            $customer->statePayment = $invoceMenor->statePayment;
            $customer->paymentTimely = $invoceMenor->paymentTimely;
            $customer->save();

         return response()->json($customer->id);
      }

      public function invoiceOccasionalPreview(){
         $invoice = invoice::all()->last();
         return redirect()->route('invoiceOccasionalDetails',$invoice->id);
      }

     public function invoicePdf($id){

       $invoices = invoice::where('id', $id)->first();

       $invoiceDetails = invoiceDetail::where('invoiceNumber',$invoices->invoiceNumber)->get();

       $customer = customer::find($invoices->customer_id);

      $dateIni = \Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y');

       if($invoices->type == 'Recurrente'){
          $pdf = PDF::loadView('invoiceExample.index2',['invoices'=>$invoices,'invoiceDetails'=>$invoiceDetails,'customer'=>$customer]);
          return $pdf->download('Factura_'.$invoices->nameCustomer.'_Nro_'.$invoices->number.'_Periodo_'.$invoices->invoiceperiod.'.pdf');
       }else{

          $pdf = PDF::loadView('invoiceExample.index',['invoices'=>$invoices,'invoiceDetails'=>$invoiceDetails,'customer'=>$customer]);
          return $pdf->download('Factura_Ocasional_'.$invoices->nameCustomer.'_Nro_'.$invoices->number.'_Inicio_'.$dateIni.'.pdf');
       }

     }

     public function invoiceConfirmCustomerView($id)
     {
        $invoice = invoice::find($id);
        $customer = customer::find($invoice->customer_id);

        return view('customers.invoiceConfirmCustomer')->with('invoice',$invoice)->with('customer',$customer);
     }

     public function invoiceConfirmCustomer(Request $request)
     {

        $request->validate([
           'medioPayment'=>'required',
           'dateConfirmPayment'=>'required',

        ]);

        $mc = new messagesConfirm;
        $mc->fill($request->all());
        $mc->save();

         $invoice = invoice::where('id',$request->invoice_id)->first();
         $invoice->stateSend = 'Pago Realizado';
         $customer = customer::find($invoice->customer_id);
         $invoice->save();
         $customer->statePayment = 'Pago Realizado';
         $customer->save();

         return back()->with('success', 'Se ha enviado la Confirmacion del Pago');
     }

     public function invoicesConfirm(Request $request,$id)
     {
        $request->validate([
           'medioPayment'=>'required',
           'dateConfirmPayment'=>'required'
        ]);

         $invoice = invoice::where('id', $id)->first();

        $mccount = messagesConfirm::where('invoice_id',$id)->count();
        $mc = messagesConfirm::where('invoice_id',$id)->first();

        if($mccount > 0){
           $mc->medioPayment = $request->medioPayment;
           $mc->dateConfirmPayment = $request->dateConfirmPayment;
           $mc->save();
        }else{
           $mc2 = new messagesConfirm;


            $mc2->medioPayment = $request->medioPayment;
            $mc2->dateConfirmPayment = $request->dateConfirmPayment;
            $mc2->Banco = 'a';
            $mc2->nroReferencia = 'a';
            $mc2->mensaje = 'a';
            $mc2->invoice_id = $id;
            $mc2->invoiceperiod = $invoice->invoiceperiod;
            $mc2->save();
        }




       $invoice->statePayment = 'Pago Confirmado';
       $invoice->stateSend = 'Enviada';
       $invoice->paymentMethod = $request->medioPayment;
       $invoice->paymentDate = $request->dateConfirmPayment;
       $customer = customer::find($invoice->customer_id);
       $invoice->save();

       $invoicesCount = invoice::where('customer_id',$invoice->customer_id)->where('statePayment', 'Pendiente')->count();

       if($invoicesCount > 0){

          $invoceMenor = invoice::where('customer_id',$invoice->customer_id)->where('statePayment','Pendiente')->orderBy('paymentTimely','asc')->first();

          $customer->paymentTimely = $invoceMenor->paymentTimely;
          $customer->statePayment = $invoceMenor->statePayment;
          $customer->save();
       }else{

          $customer->statePayment = 'Pago Confirmado';
           $customer->save();
       }

       return back()->with('success', 'Se ha Confirmado el Pago de La Factura');

     }
     public function invoiceSends(Request $request)
     {

         $request->validate(
            ['email'=>'email|required',
            'message'=>'required'
            ]);


       $invoices = invoice::where('id',  $request->invoice_id)->first();

       $invoiceDetails = invoiceDetail::where('invoiceNumber',$invoices->invoiceNumber)->get();

       $customer = customer::find($invoices->customer_id);
      //mail.invoiceSend
      if($invoices->type == 'Recurrente'){
          $pdf = PDF::loadView('invoiceExample.index2',['invoices'=>$invoices,'invoiceDetails'=>$invoiceDetails,'customer'=>$customer]);
      }else{
         $pdf = PDF::loadView('invoiceExample.index',['invoices'=>$invoices,'invoiceDetails'=>$invoiceDetails,'customer'=>$customer]);
      }

        //return $pdf->download();
       $msg = $request->message;


      Mail::send('mail.viewMailInvoiceSend',['msg'=>$msg], function($msj) use($request,$pdf,$invoices){
         $fecha = \Carbon\Carbon::now()->format('m-d-Y');
         $msj->subject('Rastreo Satelital '.$fecha.' Eje Satelital');
         $msj->to($request->email);

         $dateIni = \Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y');
            if($invoices->type == 'Recurrente'){
               $msj->attachData($pdf->output(), 'Factura_'.$invoices->nameCustomer.'_Nro_'.$invoices->number.'_Periodo_'.$invoices->invoiceperiod.'.pdf');
            }else{
               $msj->attachData($pdf->output(),'Factura_Ocasional_'.$invoices->nameCustomer.'_Nro_'.$invoices->number.'_Inicio_'.$dateIni.'.pdf' );
            }

      });

      $invoices->stateSend = 'Enviada';
      $invoices->statePayment = 'Pendiente';
      $invoices->save();

      $customer = customer::find($invoices->customer_id);
      $customer->statePayment = 'Pendiente';
      $customer->save();

      if($request->envio == 'json'){
         return response()->json(['user'=>$customer->name]);
      }else{
         if($invoices->type == 'Recurrente'){
            return redirect()->route('invoiceDetails',$request->invoice_id)->with('success', 'La factura se ha Enviado Con Exito.');
         }else{
            return redirect()->route('invoiceOccasionalDetails',$request->invoice_id)->with('success', 'La factura se ha Enviado Con Exito.');
         }
      }

     }

     public function invoiceList($id)
     {
      $customer = customer::find($id);

      if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
         return redirect()->back()->with('danger', 'No tienes Permisos');
      }
      $invoices = invoice::where('customer_id',$id)->orderBy('id','DESC')->paginate(10);

         return view('customers.invoices')->with('invoices',$invoices)->with('customer', $customer);
     }

     public function invoiceDetails($id)
     {

        $invoice1 = invoice::where('id', $id)->first();
        $customer = customer::find($invoice1->customer_id);

       if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
          return redirect()->back()->with('danger', 'No tienes Permisos');
         }
        $invoiceDetails = invoiceDetail::where('invoiceNumber',$invoice1->invoiceNumber)->get();

        $invoices = invoice::where('id', $id)->first();

        $mConfirm = messagesConfirm::where('invoice_id',$id)->first();

         return view('customers.invoiceDetails')->with('invoices', $invoices)->with('invoiceDetails', $invoiceDetails)->with('mConfirm',$mConfirm)->with('customer',$customer);
     }

    public function index()
    {

      $invoices = invoice::all()->last();

      $invoicelast = invoice::all()->last();

      $invoiceDetails = invoiceDetail::where('invoiceNumber',$invoicelast->id)->get();

      return view('customers.invoicePreview')->with('invoiceDetails', $invoiceDetails)->with('invoices', $invoices);
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
      $invoiceCount = invoice::where('customer_id',$request->customer_id)->where('type', 'Recurrente')->count();
      if($invoiceCount != 0){

         $invoiceL = invoice::where('customer_id',$request->customer_id)->where('type', 'Recurrente')->orderBy('id','desc')->first();

         $invoiceLatest = \Carbon\Carbon::parse($invoiceL->paymentTimely)->startOfMonth()->subDay();


         if( $invoiceLatest > $request->dateIni ){
            $period1= \Carbon\Carbon::parse($request->dateIni)->format('m-Y');

            return response()->json(['error'=>'existe','message'=>'<strong>Ya existe una Factura correspondiente al periodo: '.$period1.'</strong>']);
         }
      }


      //Fecha de pago oportuno
      $paymentTimely = \Carbon\Carbon::parse($request->dateIni)->addMonth($request->months)->startOfMonth()->addDays(4);

      //Periodo de Facturacion
      $period = (int)\Carbon\Carbon::parse($request->dateIni)->format('m');
      $periodYear = \Carbon\Carbon::parse($request->dateIni)->format('Y');
      $months = $request->months;
      $i = 1;
      $periodT = '';
      while($i <= $months){
         $periodT .= $period.",";
          $period = $period + 1;
         $i++;
      }

      if($period > 13){
         return response()->json(['error'=>'existe','message'=>'La Cantidad de meses agregada desde la fecha de Inicio Marcada, sobrepasan los Periodos de este Año, Por favor ingresa una cantidad menor para evitar sobrepasar al mes de diciembre del año marcado, o configura la fecha de inicio para el año Siguiente.']);
      }
      $invoiceperiod = $periodT.' del Año: '.$periodYear;
      $invoiceperiod2 = $periodT.' del Año: '.$periodYear;

      $customer = customer::find($request->customer_id);


      $invoice_number = invoice::all()->count();

      if($invoice_number == 0){
          $invoiceNumber = 1;
      }else{
          $invoiceNumber = $invoice_number + 1;
      }

      $number = invoice::where('customer_id',$request->customer_id)->count();
      $number = $number+1;
      //$number = str_pad($number, 4, "0", STR_PAD_LEFT);


      $invoice = new invoice;
      $invoice->dateIni = $request->dateIni;
      $invoice->invoiceperiod = $invoiceperiod;
      $invoice->paymentTimely = $paymentTimely;
      $invoice->number = $number;
      $invoice->invoiceNumber = $invoiceNumber;
      $invoice->Customer_id = $customer->id;
      $invoice->idNumberCustomer = $customer->idNumber;
      $invoice->nameCustomer = $customer->name;
      $invoice->nameSeller = $customer->seller->name;
      $invoice->registered =  Auth::user()->name;
      $invoice->total = $request->total;
      $invoice->statePayment = 'Pendiente';
      $invoice->type = 'Recurrente';
      $invoice->months = $request->months;

      $invoice->save();

      //Agregar datos a CUTOMER
      $customer = customer::find($request->customer_id);

         $invoceMenor = invoice::where('customer_id',$request->customer_id)->where('statePayment','Pendiente')->orderBy('paymentTimely','asc')->first();

         $customer->statePayment = $invoceMenor->statePayment;
         $customer->paymentTimely = $invoceMenor->paymentTimely;
         $customer->save();


      $servicesv = servicesVehicles::where('customers_id', $request->customer_id);

      $servicesv = $servicesv->each(function ($service, $key) use($invoiceNumber,$number){

          $invoiceDetails = new invoiceDetail;
          $invoiceDetails->invoiceNumber = $invoiceNumber;

          $invoiceDetails->vehicle = $service->vehicles->name;
          $invoiceDetails->plate = $service->vehicles->plate;
          $invoiceDetails->type = $service->services->name;
          $invoiceDetails->description = $service->services->description;
          $invoiceDetails->payment = $service->services->payment;
          $invoiceDetails->save();
      });

      $servicesAds = servicesAds::where('customer_id',$request->customer_id);

      $servicesAds = $servicesAds->each(function ($sa, $key) use($invoiceNumber){

          $invoiceDetails = new invoiceDetail;
          $invoiceDetails->invoiceNumber = $invoiceNumber;

          $invoiceDetails->vehicle = '';
          $invoiceDetails->plate = $sa->plate;
          $invoiceDetails->type = $sa->type;
          $invoiceDetails->description = $sa->description;
          $invoiceDetails->payment = $sa->payment;
          $invoiceDetails->save();
      });

      //$invoice = invoice::where('customer_id',$request->customer_id)->get()->last();

      //$servicesAds = servicesAds::where('customer_id',$request->customer_id)->delete();

      return response()->json(['exito'=>'exito','message'=>'Se ha Generado la factura para un periodo Total de '.$months.' Mes(es) especificamente los periodos: <strong style="color:green">'.$invoiceperiod.'</strong> Por el Monto Total de <strong>'.$request->total.'</strong><br><br>Presione <strong>"Aceptar"</strong> para conservar o <strong>"Cancelar"</strong> para reinicar el proceso de creación']);
      //return view('mail.viewmail')->with('sv', $sv)->with('customer', $customer)->with('servicesads', $servicesads);
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
