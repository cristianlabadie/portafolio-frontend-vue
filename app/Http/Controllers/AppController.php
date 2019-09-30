<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index(){

      $user = Auth::user();
      //Establecer la Sesión LaVegaID
      if(session()->has('VisitorNormal')){
        $visitor = session()->get('VisitorNormal');
      }else{
        $visitor = str_random(10) . time();
        session()->put('VisitorNormal', $visitor);
      }

      return view('index', compact( 'user'));
    }

    public function entrar(Request $req){
      $remember = true;
  		$login = Auth::attempt(['email' => $req->email, 'password' => $req->password], $remember);

  		if(!$login){
  			$respuesta['estado'] = "error";
  			$respuesta['errores'] = "Las credenciales son incorrectas.";
  		}else{
  			$respuesta['estado'] = "ok";
  		}

  		return response()->json($respuesta);

  	}
}
