<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersAdminController extends Controller
{
    public function getUsers(Request $req){
      $errores = [];

      try{

        $users = User::where('admin', true)->get();

      }catch(\Exception $e){
        report($e);
        $errores[] = $e->getMessage();
      }

      if($errores){
        $respuesta['estado'] = 'error';
        $respuesta['errores'] = $errores;
      }else{
        $respuesta['estado'] = 'ok';
        $respuesta['users'] = $users;
      }

      return response()->json($respuesta);
    }

    public function guardarCambiosPermisos(Request $req){
      $errores = [];

      try{

        $user = User::find($req->user['id']);
        $user->permisos = $req->user['permisos'];
        $user->save();

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
