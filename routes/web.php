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

Route::get('/', function () {
    return view('welcome');
});

Route::get('usuarios/{id?}', 'UserController@create');

Route::post('usuarios/crear', 'UserController@store');

Route::post('usuarios/editar/{id}', 'UserController@edit');

Route::post('usuarios/eliminar/{id}', 'UserController@delete');
