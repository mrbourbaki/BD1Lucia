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

Route::get('/reportesMiembro/{docid}/preasistencias',"ReporteMiembroController@pre_reporte2asistencias");
Route::post('/reportesMiembro/{docid}/asistencias',"ReporteMiembroController@reporte2asistencias");

Route::get('/reportesMiembro/{docid}/pregrupos',"ReporteMiembroController@pre_reporte2grupos");
Route::post('/reportesMiembro/{docid}/grupos',"ReporteMiembroController@reporte2grupos");

//8
Route::get('/reportesMiembro/{docid}/preanalizado',"ReporteMiembroController@pre_reporte8");
Route::post('/reportesMiembro/{docid}/librosanalizados',"ReporteMiembroController@reporte8");

           
//3
Route::get('/reportesClub/{cod}/pre_reporte3', "ReporteClubController@pre_reporte3");
Route::post('/reportesClub/{cod}/reporte3', "ReporteClubController@reporte43");

//4
Route::get('/reportesClub/{cod}/pre4', "ReporteClubController@pre_reporte4");
Route::post('/reportesClub/{cod}/reporte4', "ReporteClubController@reporte4");

Route::get('/reportesLibro', "Reporte7Controller@index");
Route::get('/reportesLibro/ficha/{cod}', "Reporte7Controller@ficha");

Route::get('/reportesObra', "Reporte8Controller@index");
Route::get('/reportesObra/ficha/{cod}', "Reporte8Controller@ficha");
Route::get('/reportesObra/calendario/{cod}', "Reporte8Controller@calendario");
Route::put('/reportesObra/pre8/{cod}/reporte8', "Reporte8Controller@reporte8");

Route::get('/reportesObra/elenco/{cod}', "Reporte8Controller@elenco");


//9

Route::get('/reportesObra/{cod}/prevaloracion', "ReporteObraController@pre_reporte9");
Route::post('/reportesObra/{cod}/valoracion', "ReporteObraController@reporte9");

//11
Route::get('/reportesClub/{cod}/pre_reporte11', "ReporteClubController@pre_reporte11");
Route::post('/reportesClub/{cod}/reporte11', "ReporteClubController@reporte11");

Route::get('/reportesClub', "ReporteClubController@pre_index");