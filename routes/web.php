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
    return redirect()->route('dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');    
    Route::get('/responden/anak', 'DataRespondenController@anak')->name('responden-anak');    
    Route::get('/responden/anak/filtered/{alamat?}/{tahun?}/{bulan?}', 'DataRespondenController@anak')->name('responden-anak-filtered');
    Route::get('/responden/ibu-hamil', 'DataRespondenController@ibuHamil')->name('responden-ibuhamil');
    Route::get('/responden/ibu-hamil/filtered/{alamat?}/{tahun?}/{bulan?}', 'DataRespondenController@ibuHamil')->name('responden-ibuhamil-filtered');
    Route::get('/responden/wus', 'DataRespondenController@wus')->name('responden-wus');
    Route::get('/responden/wus/filtered/{alamat?}/{tahun?}/{bulan?}', 'DataRespondenController@wus')->name('responden-wus-filtered');
    Route::delete('/responden/hapus/{id}', 'DataRespondenController@delete')->name('responden.delete');
    Route::get('/responden/riwayat', 'DataRespondenController@getRiwayat')->name('responden-riwayat');    

    Route::get('/kader/daftar', 'KaderController@index')->name('kader');
    Route::get('/kader/tambah-kader-baru', 'KaderController@create')->name('kader-baru');
    Route::post('/kader/tambah-kader-baru', 'KaderController@store')->name('submit-kader-baru');
    Route::get('/kader/edit-kader/{id}', 'KaderController@edit')->name('kader-edit');
    Route::post('/kader/update-kader/{id}', 'KaderController@update')->name('kader-update');
    Route::delete('/kader/hapus-kader/{id}', 'KaderController@destroy')->name('kader-hapus');
});
