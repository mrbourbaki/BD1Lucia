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
Route::post('Reunion/postIndex','ReunionController@postIndex');
Route::resource('Reunion','ReunionController');
Route::resource('Estructura','EstructuraController');
Route::get('Club/filtraMiembro/{cod}','ClubController@filtraMiembro');
Route::put('Club/agregaMiembro/{cod}','ClubController@agregaMiembro');

//Reportes

Route::get('/reportesMiembro', "ReporteMiembroController@pre_index");

//2
Route::get('/reportesMiembro/{docid}/prepagos',"ReporteMiembroController@pre_reporte2pagos")->name('prePagos');
Route::put('/reportesMiembro/{docid}/pagos',"ReporteMiembroController@reporte2pagos")->name('reporte2pagos');

Route::get('/reportesMiembro/{docid}/preasistencias',"ReporteMiembro2Controller@pre_reporte2asistencias");
Route::post('/reportesMiembro/{docid}/asistencias',"ReporteMiembro2Controller@reporte2asistencias");

Route::get('/reportesMiembro/{docid}/pregrupos',"ReporteMiembro2Controller@reporte2asistencias");
Route::post('/reportesMiembro/{docid}/grupos',"ReporteMiembro2Controller@reporte2grupos");

Route::get('/reportesMiembro/{docid}/libros',"ReporteMiembroController@reporte8")->name('Reportelibrosanalizados');

           
//3
Route::get('/reportesClub/reporte3/{cod}', "ReporteClubController@reporte3");

//4
Route::get('/reportesClub', "ReporteClubController@pre_index");
Route::get('/reportesClub/pre4/{cod}', "ReporteClubController@pre_reporte4");
Route::put('/reportesClub/pre4/{cod}/reporte4', "ReporteClubController@index");

Route::get('/reportesLibro', "Reporte7Controller@index");
Route::get('/reportesLibro/ficha/{cod}', "Reporte7Controller@ficha");

Route::get('/reportesObra', "Reporte8Controller@index");
Route::get('/reportesObra/ficha/{cod}', "Reporte8Controller@ficha");
Route::get('/reportesObra/calendario/{cod}', "Reporte8Controller@calendario");
Route::put('/reportesObra/pre8/{cod}/reporte8', "Reporte8Controller@reporte8");

Route::get('/reportesObra/elenco/{cod}', "Reporte8Controller@elenco");