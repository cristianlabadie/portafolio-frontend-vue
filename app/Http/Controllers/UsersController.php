<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function buscarUsers(Request $datos){
      $errores = [];

      try{

        $users = User::select('nombre', 'paterno', 'materno', 'email', 'id', 'saldo', 'empresa')
        ->where(function($query) use ($datos){
          if($datos->empresa){
            $query->where('empresa', true);
          }else{
            return false;
          }
        })
        ->where(function($query) use ($datos){
          if($datos->busqueda){
            $query->where('nombre', 'LIKE', '%'.$datos->busqueda.'%')
            ->orWhere('paterno', 'LIKE', '%'.$datos->busqueda.'%')
            ->orWhere('paterno', 'LIKE', '%'.$datos->busqueda.'%')
            ->orWhere('materno', 'LIKE', '%'.$datos->busqueda.'%')
            ->orWhere('email', 'LIKE', '%'.$datos->busqueda.'%')
            ->orWhere('id', $datos->busqueda);
          }else{
            return false;
          }
        })
        ->get();



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

    public function getUser(Request $datos){
      $errores = [];

      try{

        $user = User::find($datos->id);

        if(!$user){
          $errores[] = "No existe usuario con ID {$datos->id}";
        }

      }catch(\Exception $e){
        report($e);
        $errores[] = $e->getMessage();
      }

      if($errores){
        $respuesta['estado'] = 'error';
        $respuesta['errores'] = $errores;
      }else{
        $respuesta['estado'] = 'ok';
        $respuesta['user'] = $user;
      }

      return response()->json($respuesta);
    }
}
