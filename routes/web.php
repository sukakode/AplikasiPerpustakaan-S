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
      Route::delete('/{peminjaman}/delete', 'Backend\PeminjamanController@destroy')->name('destroy');
      Route::get('/{peminjaman}/history', 'Backend\PeminjamanController@history')->name('history');
    });

    Route::group(['prefix' => 'pengembalian', 'as' => 'pengembalian.'], function() {
      Route::get('/', 'Backend\PengembalianController@index')->name('index');
      Route::delete('/{pengembalian}/delete', 'Backend\PengembalianController@destroy')->name('destroy');
      Route::get('/{pengembalian}/history', 'Backend\PengembalianController@history')->name('history');
    });

    Route::group(['prefix' => 'restore', 'as' => 'restore.'], function () {
      Route::put('buku/{id}', 'Backend\BukuController@restore')->name('buku');
      Route::put('anggota/{id}', 'Backend\AnggotaController@restore')->name('anggota');
      Route::put('petugas/{id}', 'Backend\PetugasController@restore')->name('petugas');
      Route::put('peminjaman/{id}', 'Backend\PeminjamanController@restore')->name('peminjaman');
      Route::put('pengembalian/{id}', 'Backend\PengembalianController@restore')->name('pengembalian');
    });

    Route::group(['prefix' => 'exportPrint', 'as' => 'print.'], function() {
      Route::get('buku', 'Backend\BukuController@print')->name('buku');
      Route::post('buku', 'Backend\BukuController@reportPrint')->name('buku');
      Route::get('anggota', 'Backend\AnggotaController@print')->name('anggota');
      Route::post('anggota', 'Backend\AnggotaController@reportPrint')->name('anggota');
      Route::get('petugas', 'Backend\PetugasController@print')->name('petugas');
      Route::post('petugas', 'Backend\PetugasController@reportPrint')->name('petugas');
      Route::get('peminjaman', 'Backend\PeminjamanController@print')->name('peminjaman');
      Route::get('pengembalian', 'Backend\PengembalianController@print')->name('pengembalian');
    });

    Route::group(['prefix' => 'report', 'as' => 'report.'], function() {
      Route::get('buku', 'Backend\BukuController@report')->name('buku');
      Route::get('anggota', 'Backend\AnggotaController@report')->name('anggota');
      Route::get('petugas', 'Backend\PetugasController@report')->name('petugas');
    });
  });
});


Route::get('/home', 'HomeController@index')->name('home');
