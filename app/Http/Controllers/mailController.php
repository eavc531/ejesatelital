<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoice;
use App\customer;
use Mail;
use Auth;
class mailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function contact()
     {
        $customer = customer::find(Auth::user()->customer_id);
         return view('customers.contact')->with('customer', $customer);
     }
     public function sendMessage(Request $request)
     {
        $name = $request->name;
        $nameemail = $request->email;
        $msg = $request->msg;
        Mail::send('mail.viewmail',['name'=>$name,'nameemail'=>$nameemail,'msg'=>$msg], function($msj) use($request){
          $msj->subject('Cliente Eje Satelital: '.$request->name);
          $msj->to('testprogramas531@gmail.com');

      });

      return redirect()->route('home')->with('success', 'Mensaje Enviado Satisfactoriamente');
     }

     public function mailCustomer($id)
     {
        $customer = customer::find($id);
         return view('mail.sendMailCustomer')->with('customer', $customer);
     }
     public function sendMessageCustomer(Request $request)
     {
        $request->validate([
            'email'=>'required',
            'mensaje'=>'required'
        ]);

        $name = $request->name;
        $nameemail = $request->email;
        $msg = $request->mensaje;
        $subject = $request->subject;
        
        Mail::send('mail.viewMailCustomer',['name'=>$name,'nameemail'=>$nameemail,'msg'=>$msg, 'subject'=>$subject], function($msj) use($request){
          $msj->subject($request->subject);
          $msj->to($request->email);

       });

       return redirect()->route('mailCustomer',$request->id)->with('success', 'Mensaje Enviado Satisfactoriamente');
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

     ///////////////////////////////////////////////////
      $invoiceN = invoice::all()->count();

      if($invoiceN == 0){
         $invoiceNumber = 1;
      }else{
         $invoiceNumber = $invoiceN + 1;
      }


      $customer = customer::find($request->customer_id);

      $invoice = new invoice;
      $invoice->idNumberCustomer = $customer->idNumberCustomer;
      $invoice->Customer = $customer->name;
      $invoice->addressCustomer = $customer->address . $customer->city;
      $invoice->typeService =
      $invoice->custormer =
      $invoice->custormer =
      $invoice->custormer =

      $servicesads = servicesAds::where('customer_id', $id)->get();
      //$ve = vehicle::where('customer_id',$id)->get();
      /*$sv = servicesVehicles::where('customers_id',$id)->get();
      return view('customers.services')->with('sv', $sv)->with('customer', $customer)->with('servicesads', $servicesads);*/




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
