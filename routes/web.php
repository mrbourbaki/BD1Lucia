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

Route::resource('Libro','LibroController');
Route::get('Lector/Pago/{docidentidad}','LectorController@Pagos') ;
Route::resource('Lector','LectorController');
Route::resource('Editorial','EditorialController');
Route::resource('Clase','ClaseController');
Route::resource('Institucion','InstitucionController');
Route::resource('Club','ClubController');
Route::resource('Obra','ObraController');
Route::resource('Sala','SalaController');
Route::resource('Reunion','ReunionController');
Route::resource('Estructura','EstructuraController');
Route::get('Club/filtraMiembro/{cod}','ClubController@filtraMiembro');
Route::put('Club/agregaMiembro/{cod}','ClubController@agregaMiembro');
