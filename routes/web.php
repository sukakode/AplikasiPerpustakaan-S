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

Auth::routes(['register' => false]);

Route::get('/', 'Frontend\MainController@index')->name('frontend.main');
Route::middleware(['auth'])->group(function () {
  Route::group(['prefix' => 'backend'], function () {
    Route::get('/', 'Backend\MainController@index')->name('backend.main');
    
    Route::resource('buku', 'Backend\BukuController', ['except' => ['show']]);

    
    Route::resource('anggota', 'Backend\AnggotaController');
    Route::resource('petugas', 'Backend\PetugasController');
  
    Route::group(['prefix' => 'peminjaman', 'as' => 'peminjaman.'], function () {
      Route::get('/', 'Backend\PeminjamanController@create')->name('create');
      Route::get('/data', 'Backend\PeminjamanController@index')->name('index');
      Route::post('/', 'Backend\PeminjamanController@store')->name('store');
      Route::get('/{peminjaman}/edit', 'Backend\PeminjamanController@edit')->name('edit');
      Route::put('/{peminjaman}/update', 'Backend\PeminjamanController@update')->name('update');
    });

    Route::group(['prefix' => 'pengembalian', 'as' => 'pengembalian.'], function() {
      Route::get('/', 'Backend\PengembalianController@index')->name('index');
    });
  
    Route::group(['prefix' => 'restore', 'as' => 'restore.'], function () {
      Route::put('buku/{id}', 'Backend\BukuController@restore')->name('buku');
      Route::put('anggota/{id}', 'Backend\AnggotaController@restore')->name('anggota');
      Route::put('petugas/{id}', 'Backend\PetugasController@restore')->name('petugas');
    });
  });
});


Route::get('/home', 'HomeController@index')->name('home');
