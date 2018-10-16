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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/meses/asignar',[
    'uses'  => 'FaseController@asignar'
]);

Route::post('/SubirAchivos',[
    'uses'  => 'ArchivoController@subir'
]);

Route::get('/comentarios/adjunto/{adjunto}/nombre/{nombre}', function ($nombre_original, $nombre_etiqueta) {
    return response()->download(storage_path("app/public/comentarios/{$nombre_original}"),$nombre_etiqueta);
});

Route::get('/comentarios/adjunto/{adjunto}/nombre/{nombre}', function ($nombre_original, $nombre_etiqueta) {
   return response()->download(storage_path("app/public/victor/{$nombre_original}"),$nombre_etiqueta);
});

Route::get('/download',[
    'uses'  => 'ArchivoController@download'
]);