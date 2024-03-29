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
Route::resource('databaseHarga', 'DatabaseHargaController');
Route::post('tesWord', 'InisiasiPengadaanController@tesWord');
Route::post('tesWordBAPL', 'InisiasiPengadaanController@tesWordBAPL');
Route::post('tesWordUPL', 'InisiasiPengadaanController@tesWordUPL');
Route::post('tesWordUPP', 'InisiasiPengadaanController@tesWordUPP');
Route::post('tesWordPDP', 'InisiasiPengadaanController@tesWordPDP');
Route::get('get-box/{box_id}' , 'BoxesController@getOneBoxData');
