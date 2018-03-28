<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notification;
use Auth;
use App\note;
class notificationsController extends Controller
{
   public function notifications()
   {
      if(Auth::user()->role == 'Administrador'){
         $notifications = notification::where('validate','no')->where('for', 'Administrador')->orderBy('id','desc')->paginate(10);
      }else{
         $notifications = notification::where('validate','no')->where('for', Auth::user()->id)->orderBy('id','desc')->paginate(10);
      }


     return view('viewNotifications.notifications')->with('notifications', $notifications);
   }

   public function notificationsViewed()
   {
      if(Auth::user()->role == 'Administrador'){
        $notifications = notification::where('validate','si')->where('for', 'Administrador')->orderBy('id','desc')->paginate(10);
      }else{
        $notifications = notification::where('validate','si')->where('for', Auth::user()->id)->orderBy('id','desc')->paginate(10);
      }

     return view('viewNotifications.notificationsViewed')->with('notifications', $notifications);
   }


   public function VerifiednotificationNewUser($id,$seller_id,$customer_id){
      $notification = notification::find($id);

      $notification->validate = 'si';
      $notification->save();

      return redirect()->route('customersDetails',$customer_id);
   }


      public function VerifiednotificationNewNote($id,$seller_id,$customer_id){
         $notification = notification::find($id);

         $notification->validate = 'si';
         $notification->save();

         return redirect()->route('notesList',$customer_id);
      }
   public function VerifiednotificationNewDocu($id,$seller_id,$customer_id){
      $notification = notification::find($id);

      $notification->validate = 'si';
      $notification->save();

      return redirect()->route('listDocuments',$customer_id);
   }

   public function verifiednotification($id){
      $notification = notification::find($id);

      $notification->validate = 'si';
      $notification->save();

      return back()->with('success', 'Notificacion Marcada como Vista');
   }

}
