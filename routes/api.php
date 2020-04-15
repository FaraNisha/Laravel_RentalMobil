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

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function() {
  return Auth::user()->level;})->middleware('jwt.verify');

Route::post('tambah_penyewa', 'PenyewaController@store')->middleware('jwt.verify');
Route::put('edit_penyewa/{id}', 'PenyewaController@update')->middleware('jwt.verify');
Route::delete('hapus_penyewa/{id}', 'PenyewaController@destroy')->middleware('jwt.verify');

Route::post('tambah_mobil', 'MobilController@store')->middleware('jwt.verify');
Route::put('edit_mobil/{id}', 'MobilController@update')->middleware('jwt.verify');
Route::delete('hapus_mobil/{id}', 'MobilController@destroy')->middleware('jwt.verify');

Route::post('tambah_jenis', 'Jenis_MobilController@store')->middleware('jwt.verify');
Route::put('edit_jenis/{id}', 'Jenis_MobilController@update')->middleware('jwt.verify');
Route::delete('hapus_jenis/{id}', 'Jenis_MobilController@destroy')->middleware('jwt.verify');
