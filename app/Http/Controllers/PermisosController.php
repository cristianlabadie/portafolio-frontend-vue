<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

use App\Models\User;

class PermisosController extends Controller
{
    public function getPermisos(Request $req){
      $errores = [];

      try{

        $permisos = json_decode(Storage::get("permisos.json"));



        if (!$permisos) {
          $errores = "No se encuentra el archivo de permisos";
        }

      }catch(\Exception $e){
        $errores[] = $e->getMessage();
      }

      if($errores){
        $respuesta['estado'] = 'error';
        $respuesta['errores'] = $errores;
      }else{
        $respuesta['estado'] = 'ok';
        $respuesta['permisos'] = $permisos;
      }

      return response()->json($respuesta);
    }

    public function cambioMenu(Request $req){
      $errores = [];

      try{

        $user = User::find(2);

        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $menu = $req->menu;

        $permisos[$index]->nombre = $menu['nombre'];
        $permisos[$index]->icono = $menu['icono'];
        $permisos[$index]->ruta = $menu['ruta'];

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['nombre'] = $menu['nombre'];
          $permisos[$index]['icono'] = $menu['icono'];
          $permisos[$index]['ruta'] = $menu['ruta'];
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function cambioOpcion(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexOpcion = $req->indexOpcion;
        $opcion = $req->opcion;

        $permisos[$index]->opciones[$indexOpcion]->nombre = $opcion['nombre'];

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['opciones'][$indexOpcion]['nombre'] = $opcion['nombre'];
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function agregarOpcion(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;

        $nOpciones = count($permisos[$index]->opciones);


        if(!$nOpciones){
          $nuevoId = "o-1";
        }else{
          $ultimaOpcion = $permisos[$index]->opciones[$nOpciones - 1];
          $idOpcion = explode("-", $ultimaOpcion->id);
          $nuevoId = $idOpcion[0] . "-" . (intval($idOpcion[1]) + 1);
        }


        $nuevaOpcion = [
          'id' => $nuevoId,
          'nombre' => '',
          'visible' => false
        ];

        $permisos[$index]->opciones[] = $nuevaOpcion;

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['opciones'][] = $nuevaOpcion;
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function agregarSubmenu(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;

        $nSubmenu = count($permisos[$index]->submenu);
        if(!$nSubmenu){
          $nuevoId = "s-1";
        }else{
          $ultimoSubmenu = $permisos[$index]->submenu[$nSubmenu - 1];
          $idSubmenu = explode("-", $ultimoSubmenu->id);
          $nuevoId = $idSubmenu[0] . "-" . (intval($idSubmenu[1]) + 1);
        }

        $nuevoSubmenu = [
          'id' => $nuevoId,
          'ruta' => '',
          'icono' => '',
          'opciones' => [],
          'nombre' => '',
          'visible' => false
        ];

        $permisos[$index]->submenu[] = $nuevoSubmenu;

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['submenu'][] = $nuevoSubmenu;
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function eliminarSubmenu(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexSubmenu = $req->indexSubmenu;

        unset($permisos[$index]->submenu[$indexSubmenu]);


        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          unset($permisos[$index]['submenu'][$indexSubmenu]);
          $admin->permisos = $permisos;
          $admin->save();
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

    public function eliminarOpcion(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexOpcion = $req->indexOpcion;

        unset($permisos[$index]->opciones[$indexOpcion]);
        $permisos[$index]->opciones = array_values($permisos[$index]->opciones);

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          unset($permisos[$index]['opciones'][$indexOpcion]);
          $permisos[$index]['opciones'] = array_values($permisos[$index]['opciones']);
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function agregarOpcionSubmenu(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexSubmenu = $req->indexSubmenu;

        $nOpciones = count($permisos[$index]->submenu[$indexSubmenu]->opciones);

        if(!$nOpciones){
          $nuevoId = "s-{$indexSubmenu}-1";
        }else{
          $ultimaSubmenuOpcion = $permisos[$index]->submenu[$indexSubmenu]->opciones[$nOpciones - 1];
          $idSubmenuOpcion = explode("-", $ultimaSubmenuOpcion->id);
          $nuevoId = $idSubmenuOpcion[0] . "-" . $idSubmenuOpcion[1] . "-" . (intval($idSubmenuOpcion[2]) + 1);
        }

        $nuevaOpcion = [
          'id' => $nuevoId,
          'nombre' => '',
          'visible' => false
        ];

        $permisos[$index]->submenu[$indexSubmenu]->opciones[] = $nuevaOpcion;

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['opciones'][] = $nuevaOpcion;
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function eliminarSubmenuOpcion(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexSubmenu = $req->indexSubmenu;
        $indexOpcionSubmenu = $req->indexOpcionSubmenu;

        unset($permisos[$index]->submenu[$indexSubmenu]->opciones[$indexOpcionSubmenu]);

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          unset($permisos[$index]['submenu'][$indexSubmenu]['opciones'][$indexOpcionSubmenu]);
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function cambioSubmenu(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexSubmenu = $req->indexSubmenu;
        $submenu = $req->submenu;

        $permisos[$index]->submenu[$indexSubmenu]->nombre = $submenu['nombre'];
        $permisos[$index]->submenu[$indexSubmenu]->icono = $submenu['icono'];
        $permisos[$index]->submenu[$indexSubmenu]->ruta = $submenu['ruta'];

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['submenu'][$indexSubmenu]['nombre'] = $submenu['nombre'];
          $permisos[$index]['submenu'][$indexSubmenu]['icono'] = $submenu['icono'];
          $permisos[$index]['submenu'][$indexSubmenu]['ruta'] = $submenu['ruta'];
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function cambioOpcionSubmenu(Request $req){
      $errores = [];

      try{
        $permisos = json_decode(Storage::get("permisos.json"));

        $index = $req->index;
        $indexSubmenu = $req->indexSubmenu;
        $indexOpcionSubmenu = $req->indexOpcionSubmenu;
        $opcionSubmenu = $req->opcionSubmenu;

        $permisos[$index]->submenu[$indexSubmenu]->opciones[$indexOpcionSubmenu]->nombre = $opcionSubmenu['nombre'];

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[$index]['submenu'][$indexSubmenu]['opciones'][$indexOpcionSubmenu]['nombre'] = $opcionSubmenu['nombre'];
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function agregarMenuPrincipal(Request $req){
      $errores = [];

      try{

        $permisos = json_decode(Storage::get("permisos.json"));
        $nMenuPrincipal = count($permisos);

        if(!$nMenuPrincipal){
          $nuevoId = 1;
        }else{
          $nuevoId = intval($nMenuPrincipal) + 1;
        }

        $nuevoMenuPrincipal = [
          'id' => $nuevoId,
          'ruta' => '',
          'icono' => '',
          'nombre' => '',
          'submenu' => [],
          'visible' => false,
          'opciones' => []
        ];

        $permisos[] = $nuevoMenuPrincipal;

        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          $permisos[] = $nuevoMenuPrincipal;
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }

    public function eliminarMenuPrincipal(Request $req){
      $errores = [];

      try{

        $permisos = json_decode(Storage::get("permisos.json"));

        unset($permisos[$req->index]);
        $permisos = array_values($permisos);


        Storage::put("permisos.json", json_encode($permisos));

        $admins = User::where('admin', true)->get();

        foreach($admins as $admin){
          $permisos = $admin->permisos;
          unset($permisos[$req->index]);
          $permisos = array_values($permisos);
          $admin->permisos = $permisos;
          $admin->save();
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
      }

      return response()->json($respuesta);
    }
}
