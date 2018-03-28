<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\document;
use App\customer;
use App\invoice;
use App\invoiceDetail;
use App\notification;

use Auth;
use File;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
class documentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function excelExport($id)
     {
        return "En Desarrollo";
      $invoice = invoice::find($id);

      $nameInvoice = 'Factura_Periodo_'.$invoice->invoiceperiod.'_'.$invoice->customer->name;
      $invoiceNumber = $invoice->invoiceNumber;
         Excel::create($nameInvoice, function($excel) use($id,$invoiceNumber){

            $excel->sheet('nombre de Hoja', function($sheet) use($id,$invoiceNumber) {
            //Header
            $sheet->mergeCells('A1:D1');//unir celdas
            $sheet->row(1, ['Tabla de Ejemplos']);
            $sheet->row(2, ['Servicio','Vehiculo','precio']);


            //data
            $invoiceDetail = invoiceDetail::where('invoiceNumber', $invoiceNumber)->get();

            foreach ($invoiceDetail as $invoiceD) {
               $row = [];
               $row[0] = $invoiceD->type;
               $row[1] = $invoiceD->vehicle;
               $row[2] = $invoiceD->payment;
            }
            $sheet->appendRow($row);
            });

         })->export('xls');

         /*
         $nameInvoice = 'Factura_Periodo_'.$invoice->invoiceperiod.'_'.$invoice->customer->name;
         $invoiceNumber = $invoice->invoiceNumber;
            Excel::create($nameInvoice, function($excel) use($id,$invoiceNumber){

               $excel->sheet('nombre de Hoja', function($sheet) use($id,$invoiceNumber) {
               //Header
               $sheet->mergeCells('A1:D1');
               $sheet->row()
               //data
               $invoiceDetail = invoiceDetail::where('invoiceNumber', $invoiceNumber)->get();
               $data = [];
               foreach ($invoiceDetail as $invoiceD) {
                  $row = [];
                  $row[0] = $invoiceD->type;
                  $row[1] = $invoiceD->vehicle;
                  $row[2] = $invoiceD->payment;
                  $data[] = $row;
               }
               $sheet->fromArray($data);
               });

            })->export('xls');
            */
     }

     public function download($id)
     {
      $document = document::find($id);
      $pathtoFile = public_path() .'/'. $document->path;

      return response()->download($pathtoFile);

     }


     public function listDocuments($id)
     {


      $documents = document::where('customer_id',$id)->orderBy('id','desc')->paginate(10);
      $countEnable = document::where('customer_id',$id)->where('state','disabled')->count();
      $customer = customer::find($id);
      if(Auth::user()->role == 'Vendedor' and $customer->seller_id != Auth::user()->id){
         return redirect()->back()->with('danger', 'No tienes Permisos Suficientes');
      }

      return view('customers.documents.documents')->with('documents', $documents)->with('customer', $customer)->with('countEnable',$countEnable);
     }

     public function confirmDocument($id)
     {
        $d = document::find($id);
        $d->state = 'enable';

        $customer = customer::find($d->customer_id);



        $notification = new notification;
        $notification->notification = 'Documento Confirmado';
         $notification->execute = 'El Documento: "'.$d->name.'" subido para el Cliente:  "'.$customer->name.'" ha sido Aprobado por el Administrador.';
       $notification->Extra = 'Administrador';
       $notification->validate = 'no';
       $notification->customer_id = $customer->id;
       $notification->seller_id = $customer->seller_id;
       $notification->for = $customer->seller_id;
       $notification->save();

        $d->save();
        return back()->with('success', 'El Documento: '.$d->name.' a sido Aprobado');
     }
    public function index()
    {

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
         'name'=> ['required',Rule::unique('documents')->where('customer_id',$request->customer_id)],
         'archivo'=>'required'
      ]);

      $customer = customer::find($request->customer_id);
      $document = new document;

      $namePath = 'Documentos/'.$customer->idNumber; // upload path
      $extension = $request->file('archivo')->getClientOriginalExtension();

      $fileName = $request->name.'.'.$extension;

      $document->path = $namePath.'/'.$fileName;
      $document->name = $request->name;
      $document->customer_id = $request->customer_id;
      $document->format = '.'.$extension;
      $pathSave = base_path().'/public/Documentos/'.$customer->idNumber; // upload path
      $request->file('archivo')->move($pathSave, $fileName); // uploading file to given path

      if(Auth::user()->role == 'Administrador'){
         $document->state = 'enable';
         $document->save();
         return back()->with('success', 'Archivo Guardado con Exito');
      }

      $document->save();

     $notification = new notification;
     $notification->notification = 'Nuevo Documento Agregado';
     $notification->execute = 'El usuario: "'.Auth::user()->name.'" a Agregado un documento Con referencia al Cliente: "'.$customer->name.'"';
     $notification->validate = 'no';
     $notification->extra = Auth::user()->name;
     $notification->customer_id =  $request->customer_id;
     $notification->seller_id = Auth::user()->id;
     $notification->for = 'Administrador';
     $notification->save();

      return back()->with('warning', 'El Archivo ha sido Guardado con Exito, Esperando La Confirmacion del Administrador ');

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

   public function documentDestroy(Request $request)
  {
     $document = document::find($request->id);

     File::delete($document->path);
     document::destroy($request->id);
      return back()->with('danger', 'Archivo Eliminado con Exito');

  }

  public function documentDelete($id)
{

    $document = document::find($id);

    File::delete($document->path);
    document::destroy($id);
     return back()->with('danger', 'Archivo Eliminado con Exito');

}
public function documentDelete2($id)
{

  $document = document::find($id);

  File::delete($document->path);
  $customer = customer::find($document->customer_id);

   $notification = new notification;
   $notification->notification = 'Documento rechazado';
   $notification->execute = 'El Documento: "'.$document->name.'" subido para el Cliente: "'.$customer->name.'" ha sido Rechazado por el Administrador.';
   $notification->Extra = 'Administrador';
   $notification->validate = 'no';
   $notification->customer_id = $customer->id;
   $notification->seller_id = $customer->seller_id;
   $notification->for = $customer->seller_id;
   $notification->save();

   document::destroy($id);

   return back()->with('danger', 'Documento rechazado y Eliminado');


   }
}
