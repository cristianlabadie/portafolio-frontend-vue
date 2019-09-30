<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
      $url = "http://localhost:63382/api/usuario/GetUserLogin";

      $user = [
        'email' => $req->email,
        'password' => $req->password
      ];

      $client = new Client([
        "base_uri" => $url,
        "header" => [
          "content-type" => "application/json"
        ]
      ]);

      $result = $client->post(["json" => $user]);

      $code = $result->getStatusCode();


      if (!$code == '200') {
        $errores = "Hubo un error en la autenticacion";
        $errores =
      }

      // http://localhost:63382/api/usuario/GetUserLogin

  		if(!$login){
  			$respuesta['estado'] = "error";
  			$respuesta['errores'] = "Las credenciales son incorrectas.";
  		}else{
  			$respuesta['estado'] = "ok";
  		}

  		return response()->json($respuesta);

  	}

    public function login(Request $req){
      $errores = [];

      try{

        $url = "http://localhost:63382/api/usuario/GetUserLogin";

        $user = [
          'email' => $req->email,
          'password' => $req->password
        ];

        $client = new Client([
          "base_uri" => $url,
          "header" => [
            "content-type" => "application/json"
          ]
        ]);

        $result = $client->post(["json" => $user]);

        $code = $result->getStatusCode();


        if (!$code == '200') {
          $errores = "Hubo un error en la autenticacion";
        }


      }catch(\Exception $e){
        $errores[] = $e->getMessage();
      }

      if($errores){
        $respuesta['estado'] = 'error';
        $respuesta['errores'] = $errores;
      }else{
        $respuesta['estado'] = 'ok';
      }

      return response()->json($respuesta);
    }
}
