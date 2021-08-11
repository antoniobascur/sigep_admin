<?php

use Illuminate\Http\Request;
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');
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
Route::group(['prefix' => 'centroPractica'], function () {
    Route::get('/getAll', ['uses' => 'CentroPracticasController@getAll']);
    Route::post('/save', ['uses' => 'CentroPracticasController@save']);
    Route::get('/get/{id}', ['uses' => 'CentroPracticasController@get']);
    Route::get('/delete/{id}', ['uses' => 'CentroPracticasController@delete']);
    Route::get('/getByRbd/{id}', ['uses' => 'CentroPracticasController@getByRbd']);
});

Route::group(['prefix' => 'estadoSolicitud'], function () {
    Route::get('/getAll', ['uses' => 'EstadoSolicitudController@getAll']);
    Route::post('/save', ['uses' => 'EstadoSolicitudController@save']);
    Route::post('/get/{id}', ['uses' => 'EstadoSolicitudController@get']);
    Route::get('/delete/{id}', ['uses' => 'EstadoSolicitudController@delete']);
});

Route::group(['prefix' => 'profesorTutor'], function () {
    Route::get('/getAll', ['uses' => 'ProfesorTutorController@getAll']);
    Route::post('/save', ['uses' => 'ProfesorTutorController@save']);
    Route::post('/get/{id}', ['uses' => 'ProfesorTutorController@get']);
    Route::get('/delete/{id}', ['uses' => 'ProfesorTutorController@delete']);
});

Route::group(['prefix' => 'tipoSolicitud'], function () {
    Route::get('/getAll', ['uses' => 'TipoSolicitudController@getAll']);
    Route::post('/save', ['uses' => 'TipoSolicitudController@save']);
    Route::post('/get/{id}', ['uses' => 'TipoSolicitudController@get']);
    Route::get('/delete/{id}', ['uses' => 'TipoSolicitudController@delete']);
});


Route::group(['prefix' => 'ficha'], function () {
    Route::get('/getAll', ['uses' => 'FichaController@getAll']);
    Route::post('/save', ['uses' => 'FichaController@save']);
    Route::post('/get/{id}', ['uses' => 'FichaController@get']);
    Route::get('/delete/{id}', ['uses' => 'FichaController@delete']);
});

Route::group(['prefix' => 'estudiante'], function () {
    Route::get('/getAll', ['uses' => 'EstudianteController@getAll']);
    Route::get('/getAllCarreras', ['uses' => 'EstudianteController@getAllCarreras']);
    Route::get('/get/{id}', ['uses' => 'EstudianteController@get']);

});
Route::group(['prefix' => 'form'], function () {
    Route::get('/getAll', ['uses' => 'FichaAdscripcionController@getAll']);
    Route::post('/save', ['uses' => 'FichaAdscripcionController@save']);
    Route::post('/get/{id}', ['uses' => 'FichaAdscripcionController@get']);
    Route::get('/delete/{id}', ['uses' => 'FichaAdscripcionController@delete']);
});

Route::group(['prefix' => 'estudiante'], function () {
    Route::get('/getAll', ['uses' => 'EstudianteController@getAll']);
    Route::get('/getAllCarreras', ['uses' => 'EstudianteController@getAllCarreras']);
    Route::get('/get/{id}', ['uses' => 'EstudianteController@get']);

});

Route::group(['prefix' => 'carrera'], function () {
    Route::get('/getAll', ['uses' => 'CarreraController@getAll']);
});

Route::group(['prefix' => 'asignatura'], function () {
    Route::get('/getByCode/{id}', ['uses' => 'AsignaturaController@getByCode']);
    Route::get('/getAllByUa/{id}', ['uses' => 'AsignaturaController@getAllByUa']);

});
Route::group(['prefix' => 'profesorColaborador'], function () {
    Route::get('/getAll', ['uses' => 'ProfesorColaboradorController@getAll']);
    Route::post('/save', ['uses' => 'ProfesorColaboradorController@save']);
    Route::post('/get/{id}', ['uses' => 'ProfesorColaboradorController@get']);
    Route::post('/getByRun', ['uses' => 'ProfesorColaboradorController@getByRun']);
    Route::get('/delete/{id}', ['uses' => 'ProfesorColaboradorController@delete']);
});
Route::group(['prefix' => 'cupoPractica'], function () {
    Route::get('/getAll', ['uses' => 'CuposPracticasController@getAll']);
    Route::post('/save', ['uses' => 'CuposPracticasController@save']);
    Route::post('/get/{id}', ['uses' => 'CuposPracticasController@get']);
    Route::post('/getCuposByProgramacion', ['uses' => 'CuposPracticasController@getCuposByProgramacion']);
    Route::get('/delete/{id}', ['uses' => 'CuposPracticasController@delete']);
});
Route::group(['prefix' => 'programacionPractica'], function () {
    Route::get('/getAll', ['uses' => 'ProgramacionPracticaController@getAll']);
    Route::post('/save', ['uses' => 'ProgramacionPracticaController@save']);
    Route::post('/get/{id}', ['uses' => 'ProgramacionPracticaController@get']);
    Route::get('/delete/{id}', ['uses' => 'ProgramacionPracticaController@delete']);
    Route::get('/getAllCuposProgramacion/{id}', ['uses' => 'ProgramacionPracticaController@getAllCuposProgramacion']);
});
