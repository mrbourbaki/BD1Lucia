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

//Route::resource('Libro', 'LibroController'); // Esto permite llamar al controlador del libro para hacer las respectivas llamadas  localhost8000/libro
Route::get('/Libro','LibroController@index');
Route::get('/Libro/create','LibroController@create');
Route::get('/Libro/{cod}','LibroController@destroy');