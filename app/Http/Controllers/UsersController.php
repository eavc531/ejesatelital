<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\customer;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function assign(Request $request)
     {
        $customer = customer::find($request->customer_id);
        $sellerNow = $customer->seller_id;
        $customer->seller_id = $request->user_id;
        $user = user::find($request->user_id);
        $customer->save();

        return redirect()->route('userClients',$sellerNow)->with('success', 'El Cliente: "'.$customer->name.'" ha sido asignado al Vendedor: "'.$user->name.'.');
     }

     public function assignCustomer($id)
     {
      $users = User::orderBy('id','desc')->paginate(10);
      $customer = customer::find($id);
      $user = user::find($customer->seller_id);

         return view('users.assignCustomer')->with('users', $users)->with('customer', $customer)->with('user', $user);
     }

     public function userClients($id)
     {
      $customers = customer::where('seller_id',$id)->orderBy('id','desc')->paginate(10);
      $user = User::find($id);
         return view('users.userClients')->with('user', $user)->with('customers', $customers);
     }

    public function index()
    {
      $users = User::where('role','Administrador')->orWhere('role','Vendedor')->orderBy('id','desc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('users.create');

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
          'name' => 'required|unique:users',
          'email' => 'email|required|unique:users|unique:customers|',
          'password'=> 'required'
      ]);


        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario Creado Con Exito.');
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
      $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
      //dd('hola')
      $user = User::find($id);
      if($request->name == $user->name){
         $request->validate([
             'name' => 'required',
             'email' => 'required',

         ]);
      }else {
         $request->validate([
             'name' => 'required|unique:Users',
             'email' => 'required',

         ]);
      }


      $user->name = $request->name;
      $user->email = $request->email;
      if($request->password != null){
         $user->password = bcrypt($request->password);
      }


      $user->role = $request->rol;

      $user->save();
       return redirect()->route('users.index')->with('success', 'Usuario Actualizado Con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = customer::where('seller_id',$id)->count();

        $user = User::find($id);
        if($user->role == 'Administrador'){
            return redirect()->route('users.index')->with('warning', 'No es Posible Eliminar Usuarios que poseen permisos de Administrador.');
        }elseif($customer > 0){
               return redirect()->route('users.index')->with('warning', 'Imposible Eliminar este Usuario, Este Usuario tiene: "'.$customer.'" Cliente(s) Asignado(s).');
        }else{
           User::destroy($id);

          return redirect()->route('users.index')->with('danger', 'Usuario Eliminado Con Exito.');
        }


    }
}
