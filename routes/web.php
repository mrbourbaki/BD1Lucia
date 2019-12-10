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
Route::resource('Libro', 'LibroController'); 

<<<<<<< HEAD
Route::get('Lector/Pago/{docidentidad}','LectorController@Pagos') ;
Route::resource('Lector','LectorController');
=======
Route::resource('Libro', 'LibroController'); // Esto permite llamar al controlador del libro para hacer las respectivas llamadas  localhost8000/libro
Route::resource('Editorial', 'EditorialController');
Route::resource('Clase', 'ClaseController');
//Route::get('/Libro','LibroController@index');
//Route::get('/Libro/create','LibroController@create');
//Route::post('/Libro','LibroController@store');
//Route::get('/Libro/{cod}','LibroController@destroy');
>>>>>>> d39700445ceb4c797ab750379c5b4fbd395751fd
