<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//ruta de prueba
Route::get('admin/les', 'AdminAgendaController@index');


Route::get('admin/miusuario', 'AdminDatosUsuariosController@index');

Route::post('admin/empresa', 'AdminEmpresaController@store');
Route::post('admin/recargar', 'AdminTransaccionController@storeRecarga');
Route::post('admin/acreditacion/solicitud', 'AdminTransaccionController@storeAcreditacion');
Route::get('admin/acreditacion', 'AdminTransaccionController@acreditacion');

Route::post('admin/empresa/provincias/{id}', 'AdminEmpresaController@provincias');
Route::put('admin/empresa/{id}', 'AdminEmpresaController@update');



Route::get('admin/transacciones_aprobar/solicitud/aprobada/{id}', 'AdminTransaccionesController@aprobarAcreditacion');
Route::get('admin/transacciones_aprobar/solicitud/denegada/{id}', 'AdminTransaccionesController@denegarAcreditacion');

Route::get('admin/debitar/transaccion/{id}', 'AdminTransaccionesAllController@index');

Route::post('admin/debitar', 'AdminTransaccionesAllController@store');
Route::post('admin/users', 'AdminCmsUsersController@store');
Route::put('admin/users/{id}', 'AdminCmsUsersController@update');

Route::post('admin/banco', 'AdminBancoController@store');
Route::put('admin/banco/{id}', 'AdminBancoController@update');

//Route::get('admin/demo', 'SoapController@demo1');