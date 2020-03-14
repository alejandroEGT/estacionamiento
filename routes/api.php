<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::get('ingreso_vehiculo/{id}','ClienteController@listar');
 Route::get('test','ClienteController@test');


Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'auth.jwt'], function () {
     Route::get('auth/user', 'AuthController@user');
     Route::post('auth/logout', 'AuthController@logout');

     Route::post('ingreso','IngresovehiculoController@ingreso');
     Route::post('registrar_tarifa','IngresovehiculoController@registrar_tarifa');

     Route::get('listar_ingreso', 'IngresovehiculoController@listar_ingreso');

     Route::post('salida_vehiculo', 'SalidavehiculoController@salida_vehiculo');
     Route::get('traer_salidas', 'SalidavehiculoController@traer_salidas');
     
     
});