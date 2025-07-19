<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestingController extends Controller
{
  public function Notifies(Request $request){
    $email=$request->email;
    $name=$request->name;
    Notification::route('mail', 'daystarowolabi@gmail.com')
        ->notify(new sendUserCount($name,$email));
  }
}
