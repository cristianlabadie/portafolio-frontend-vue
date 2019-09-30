<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Ruta General Vue JS
Route::get('/{any?}/{any2?}/{any3?}/{any4?}', "AppController@index");


Route::post('entrar', 'AppController@entrar');
// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/logout', function()
	{
		Auth::logout();
	Session::flush();
		return Redirect::to('/');
	});

//Users
Route::post('buscarUsers', 'UsersController@buscarUsers');
Route::post('getUser', 'UsersController@getUser');

//Usuarios Admin
Route::post('getUsersAdmin', "UsersAdminController@getUsers");
Route::post('guardarCambiosPermisos', "UsersAdminController@guardarCambiosPermisos");

//permisos

Route::post('/getPermisos', 'PermisosController@getPermisos');
Route::post('/cambioMenu', 'PermisosController@cambioMenu');
Route::post('/cambioOpcion', 'PermisosController@cambioOpcion');
Route::post('/agregarOpcion', 'PermisosController@agregarOpcion');
Route::post('/eliminarOpcion', 'PermisosController@eliminarOpcion');
Route::post('/agregarSubmenu', 'PermisosController@agregarSubmenu');
Route::post('/eliminarSubmenu', 'PermisosController@eliminarSubmenu');
Route::post('/agregarOpcionSubmenu', 'PermisosController@agregarOpcionSubmenu');
Route::post('/eliminarSubmenuOpcion', 'PermisosController@eliminarSubmenuOpcion');
Route::post('/cambioSubmenu', 'PermisosController@cambioSubmenu');
Route::post('/cambioOpcionSubmenu', 'PermisosController@cambioOpcionSubmenu');
Route::post('/agregarMenuPrincipal', 'PermisosController@agregarMenuPrincipal');
Route::post('/eliminarMenuPrincipal', 'PermisosController@eliminarMenuPrincipal');
