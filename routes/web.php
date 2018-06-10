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
    return view('auth/login1');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Data Master
//LokasiOwaController
Route::get('/lokasi_owa', 'LokasiOwaController@index');
Route::get('/lokasi_owa/create', 'LokasiOwaController@create');
Route::post('/lokasi_owa', 'LokasiOwaController@store');
Route::get('/lokasi_owa/{id}', 'LokasiOwaController@show');
Route::get('/lokasi_owa/{id}/edit', 'LokasiOwaController@edit');
Route::put('/lokasi_owa/{id}', 'LokasiOwaController@update');
Route::delete('/lokasi_owa/{id}', 'LokasiOwaController@destroy');

//Jenis hutan
Route::get('/jenis_hutan', 'JenisHutanController@index');
Route::get('/jenis_hutan/create', 'JenisHutanController@create');
Route::post('/jenis_hutan', 'JenisHutanController@store');
Route::get('/jenis_hutan/{id}', 'JenisHutanController@show');
Route::get('/jenis_hutan/{id}/edit', 'JenisHutanController@edit');
Route::put('/jenis_hutan/{id}', 'JenisHutanController@update');
Route::delete('/jenis_hutan/{id}', 'JenisHutanController@destroy');

//KabupatenController
Route::get('/kabupaten', 'KabupatenController@index');
Route::get('/kabupaten/create', 'KabupatenController@create');
Route::post('/kabupaten', 'KabupatenController@store');
Route::get('/kabupaten/{id}', 'KabupatenController@show');
Route::get('/kabupaten/{id}/edit', 'KabupatenController@edit');
Route::put('/kabupaten/{id}', 'KabupatenController@update');
Route::delete('/kabupaten/{id}', 'KabupatenController@destroy');
// Akhir Data tunggal

//Data banyak
//OwaController
Route::get('/owa', 'OwaController@index');
Route::get('/owa/grafik', 'OwaController@grafik');
Route::get('/owa/create', 'OwaController@create');
Route::post('/owa', 'OwaController@store');
Route::get('/owa/{id}', 'OwaController@show');
Route::get('/owa/{id}/edit', 'OwaController@edit');
Route::put('/owa/{id}', 'OwaController@update');
Route::delete('/owa/{id}', 'OwaController@destroy');

//WisataController
Route::get('/wisata', 'WisataController@index');
Route::get('/wisata/map', 'WisataController@map');
Route::get('/wisata/create', 'WisataController@create');
Route::post('/wisata', 'WisataController@store');
Route::get('/wisata/{id}', 'WisataController@show');
Route::get('/wisata/{id}/edit', 'WisataController@edit');
Route::put('/wisata/{id}', 'WisataController@update');
Route::delete('/wisata/{id}', 'WisataController@destroy');

//Luas Hutan
Route::get('/luas_hutan', 'LuasHutanController@index');
Route::get('/luas_hutan/create', 'LuasHutanController@create');
Route::post('/luas_hutan', 'LuasHutanController@store');
Route::get('/luas_hutan/{id}', 'LuasHutanController@show');
Route::get('/luas_hutan/{id}/edit', 'LuasHutanController@edit');
Route::put('/luas_hutan/{id}', 'LuasHutanController@update');
Route::delete('/luas_hutan/{id}', 'LuasHutanController@destroy');

//Luas Hutan Beda
Route::get('/luas_hutan_beda', 'LuasHutanBedaController@index');
Route::get('/luas_hutan_beda/create', 'LuasHutanBedaController@create');
Route::post('/luas_hutan_beda', 'LuasHutanBedaController@store');
Route::get('/luas_hutan_beda/{id}', 'LuasHutanBedaController@show');
Route::get('/luas_hutan_beda/{id}/edit', 'LuasHutanBedaController@edit');
Route::put('/luas_hutan_beda/{id}', 'LuasHutanBedaController@update');
Route::delete('/luas_hutan_beda/{id}', 'LuasHutanBedaController@destroy');
// Akhir Data banyak

//Contoh
//OwalokasiController
Route::get('/owa_lokasi', 'OwalokasiController@index');
Route::get('/owa_lokasi/create', 'OwalokasiController@create');
Route::post('/owa_lokasi', 'OwalokasiController@store');
Route::get('/owa_lokasi/{id}', 'OwalokasiController@show');
Route::get('/owa_lokasi/{id}/edit', 'OwalokasiController@edit');
Route::put('/owa_lokasi/{id}', 'OwalokasiController@update');
Route::delete('/owa_lokasi/{id}', 'OwalokasiController@destroy');
//Route::resource('lokasiowa', 'LokasiOwaController');
