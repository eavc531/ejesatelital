<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\note;
use App\customer;
use App\notification;
use Auth;
class notesController extends Controller
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

    public function notesList($id)
  {
      $notes = note::where('customer_id',$id)->orderBy('id','desc')->paginate(10);
      $customer = customer::find($id);
      return view('notes.notes')->with('notes',$notes)->with('customer',$customer);
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    public function notescreate($id)
  {
      $customer = customer::find($id);

      return view('notes.create')->with('customer',$customer);
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
           'title'=>'required',
           'content'=>'required|max:240',
        ]);

        $note = new note;
        $note->fill($request->all());
        $note->save();
        $notification = new notification;
        $customer = customer::find($request->customer_id);


        if(Auth::user()->role != 'Administrador'){
           $notification->notification = 'Nueva Nota Agregada';
           $notification->execute = 'El usuario: "'.Auth::user()->name.'" a Agregado Una Nota Sobre el Cliente: "'.$customer->name.'"';
           $notification->validate = 'no';
           $notification->extra = Auth::user()->name;
           $notification->customer_id =  $request->customer_id;
           $notification->seller_id = $customer->id;
           $notification->for = 'Administrador';
           $notification->save();
        }


        return redirect()->route('notesList',$request->customer_id)->with('success','Nota Agregada con Exito');
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
    public function  notesDestroy($id)
    {
        note::destroy($id);
        return back()->with('danger','Nota Eliminada con Exito');
    }

    public function destroy($id)
    {

    }
}
