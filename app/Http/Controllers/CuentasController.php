<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuentasController extends Controller
{
    public function crearCuenta(Request $req){
      $errores = [];

      try{



      }catch(\Exception $e){
        report($e);
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
