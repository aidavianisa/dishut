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
    return view('auth/login');
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
Route::get('/owa/excel', 'OwaController@excel')->name('owa.excel');
Route::get('/owa/lahan_kritis', 'OwaController@lahan_kritis');
Route::get('/owa/kebakaran', 'OwaController@kebakaran');
Route::get('/owa/create', 'OwaController@create');
Route::post('/owa', 'OwaController@store');
Route::get('/owa/{id}', 'OwaController@show');
Route::get('/owa/{id}/edit', 'OwaController@edit');
Route::put('/owa/{id}', 'OwaController@update');
Route::delete('/owa/{id}', 'OwaController@destroy');

//DataLuasController
//lahan kritis
Route::get('/data_luas', 'DataLuasController@index')->name('data_luas');
Route::get('/data_luas/grafik', 'DataLuasController@grafik');
Route::get('/data_luas/excel', 'DataLuasController@excel')->name('data_luas.excel');
Route::get('/data_luas/create', 'DataLuasController@create');
Route::post('/data_luas', 'DataLuasController@store');
Route::get('/data_luas/{id}', 'DataLuasController@show');
Route::get('/data_luas/{id}/edit', 'DataLuasController@edit');
Route::put('/data_luas/{id}', 'DataLuasController@update');
Route::delete('/data_luas/{id}', 'DataLuasController@destroy');
//kebakaran
Route::get('/data_luas_kebakaran/', 'DataLuasController@kebakaran')->name('data_luas_kebakaran');
Route::get('/data_luas_kebakaran/create', 'DataLuasController@create_kebakaran');
Route::get('/data_luas_kebakaran/excel', 'DataLuasController@excel_kebakaran')->name('data_luas.excel_kebakaran');
Route::post('/data_luas_kebakaran', 'DataLuasController@store_kebakaran');
Route::get('/data_luas_kebakaran/{id}', 'DataLuasController@show_kebakaran');
Route::get('/data_luas_kebakaran/{id}/edit', 'DataLuasController@edit_kebakaran');
Route::put('/data_luas_kebakaran/{id}', 'DataLuasController@update_kebakaran');
Route::delete('/data_luas_kebakaran/{id}', 'DataLuasController@destroy_kebakaran');

//WisataController
Route::get('/wisata', 'WisataController@index');
Route::get('/wisata/map', 'WisataController@map');
Route::get('/wisata/create', 'WisataController@create');
Route::post('/wisata', 'WisataController@store');
Route::get('/wisata/{id}', 'WisataController@show');
Route::get('/wisata/{id}/edit', 'WisataController@edit');
Route::get('/wisata/{id}/lihat', 'WisataController@lihat');
Route::put('/wisata/{id}', 'WisataController@update');
Route::delete('/wisata/{id}', 'WisataController@destroy');

//PotensiWisataController
Route::get('/potensi_wisata', 'PotensiWisataController@index');
Route::get('/potensi_wisata/map', 'PotensiWisataController@map');
Route::get('/potensi_wisata/create', 'PotensiWisataController@create');
Route::post('/potensi_wisata', 'PotensiWisataController@store');
Route::get('/potensi_wisata/{id}', 'PotensiWisataController@show');
Route::get('/potensi_wisata/{id}/edit', 'PotensiWisataController@edit');
Route::get('/potensi_wisata/{id}/lihat', 'PotensiWisataController@lihat');
Route::put('/potensi_wisata/{id}', 'PotensiWisataController@update');
Route::delete('/potensi_wisata/{id}', 'PotensiWisataController@destroy');

//Luas Hutan Beda
Route::get('/luas_hutan_beda', 'LuasHutanBedaController@index');
Route::get('/luas_hutan_beda/excel', 'LuasHutanBedaController@excel');
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

//Luas Hutan
Route::get('/luas_hutan', 'LuasHutanController@index');
Route::get('/luas_hutan/excel', 'LuasHutanController@excel')->name('luas_hutan.excel');
Route::get('/luas_hutan/create', 'LuasHutanController@create');
Route::post('/luas_hutan', 'LuasHutanController@store');
Route::get('/luas_hutan/{id}', 'LuasHutanController@show');
Route::get('/luas_hutan/{id}/edit', 'LuasHutanController@edit');
Route::put('/luas_hutan/{id}', 'LuasHutanController@update');
Route::delete('/luas_hutan/{id}', 'LuasHutanController@destroy');

//Luas Hutan Produksi
Route::get('/hutan_produksi', 'HutanProduksiController@index');
Route::get('/hutan_produksi/excel', 'HutanProduksiController@excel')->name('hutan_produksi.excel');
Route::get('/hutan_produksi/create', 'HutanProduksiController@create');
Route::post('/hutan_produksi', 'HutanProduksiController@store');
Route::get('/hutan_produksi/{id}', 'HutanProduksiController@show');
Route::get('/hutan_produksi/{id}/edit', 'HutanProduksiController@edit');
Route::put('/hutan_produksi/{id}', 'HutanProduksiController@update');
Route::delete('/hutan_produksi/{id}', 'HutanProduksiController@destroy');

//Luas Hutan Lindung
Route::get('/hutan_lindung', 'HutanLindungController@index');
Route::get('/hutan_lindung/excel', 'HutanLindungController@excel')->name('hutan_lindung.excel');
Route::get('/hutan_lindung/create', 'HutanLindungController@create');
Route::post('/hutan_lindung', 'HutanLindungController@store');
Route::get('/hutan_lindung/{id}', 'HutanLindungController@show');
Route::get('/hutan_lindung/{id}/edit', 'HutanLindungController@edit');
Route::put('/hutan_lindung/{id}', 'HutanLindungController@update');
Route::delete('/hutan_lindung/{id}', 'HutanLindungController@destroy');

//Luas Cagar Alam
Route::get('/cagar_alam', 'CagarAlamController@index');
Route::get('/cagar_alam/excel', 'CagarAlamController@excel')->name('cagar_alam.excel');
Route::get('/cagar_alam/create', 'CagarAlamController@create');
Route::post('/cagar_alam', 'CagarAlamController@store');
Route::get('/cagar_alam/{id}', 'CagarAlamController@show');
Route::get('/cagar_alam/{id}/edit', 'CagarAlamController@edit');
Route::put('/cagar_alam/{id}', 'CagarAlamController@update');
Route::delete('/cagar_alam/{id}', 'CagarAlamController@destroy');

//Luas Suaka Margasatwa
Route::get('/suaka_margasatwa', 'SuakaMargasatwaController@index');
Route::get('/suaka_margasatwa/excel', 'SuakaMargasatwaController@excel')->name('suaka_margasatwa.excel');
Route::get('/suaka_margasatwa/create', 'SuakaMargasatwaController@create');
Route::post('/suaka_margasatwa', 'SuakaMargasatwaController@store');
Route::get('/suaka_margasatwa/{id}', 'SuakaMargasatwaController@show');
Route::get('/suaka_margasatwa/{id}/edit', 'SuakaMargasatwaController@edit');
Route::put('/suaka_margasatwa/{id}', 'SuakaMargasatwaController@update');
Route::delete('/suaka_margasatwa/{id}', 'SuakaMargasatwaController@destroy');

//Luas Taman Wisata Alam
Route::get('/taman_wisata_alam', 'TamanWisataAlamController@index');
Route::get('/taman_wisata_alam/excel', 'TamanWisataAlamController@excel')->name('taman_wisata_alam.excel');
Route::get('/taman_wisata_alam/create', 'TamanWisataAlamController@create');
Route::post('/taman_wisata_alam', 'TamanWisataAlamController@store');
Route::get('/taman_wisata_alam/{id}', 'TamanWisataAlamController@show');
Route::get('/taman_wisata_alam/{id}/edit', 'TamanWisataAlamController@edit');
Route::put('/taman_wisata_alam/{id}', 'TamanWisataAlamController@update');
Route::delete('/taman_wisata_alam/{id}', 'TamanWisataAlamController@destroy');

//Luas Taman Nasional
Route::get('/taman_nasional', 'TamanNasionalController@index');
Route::get('/taman_nasional/excel', 'TamanNasionalController@excel')->name('taman_nasional.excel');
Route::get('/taman_nasional/create', 'TamanNasionalController@create');
Route::post('/taman_nasional', 'TamanNasionalController@store');
Route::get('/taman_nasional/{id}', 'TamanNasionalController@show');
Route::get('/taman_nasional/{id}/edit', 'TamanNasionalController@edit');
Route::put('/taman_nasional/{id}', 'TamanNasionalController@update');
Route::delete('/taman_nasional/{id}', 'TamanNasionalController@destroy');

//Luas Taman Nasional
Route::get('/taman_hutan_raya', 'TamanHutanRayaController@index');
Route::get('/taman_hutan_raya/index', 'TamanHutanRayaController@excel')->name('taman_hutan_raya.excel');
Route::get('/taman_hutan_raya/create', 'TamanHutanRayaController@create');
Route::post('/taman_hutan_raya', 'TamanHutanRayaController@store');
Route::get('/taman_hutan_raya/{id}', 'TamanHutanRayaController@show');
Route::get('/taman_hutan_raya/{id}/edit', 'TamanHutanRayaController@edit');
Route::put('/taman_hutan_raya/{id}', 'TamanHutanRayaController@update');
Route::delete('/taman_hutan_raya/{id}', 'TamanHutanRayaController@destroy');
