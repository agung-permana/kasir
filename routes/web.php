<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => 'role:kasir', 'auth'], function() {
    Route::get('search', 'HomeController@search')->name('search');
    Route::post('add-product', 'TemporderController@addProduct')->name('addProduct');
    Route::delete('temporder/{temporder}/delete', 'TemporderController@destroy')->name('temp_order.destroy');
    Route::post('process', 'OrderController@process')->name('process');
    Route::get('detailOrder', 'OrderController@detailOrder')->name('detailOrder');
    Route::get('order/{order}/receipt', 'OrderController@receipt')->name('receipt');

});

Route::group(['middleware' => 'role:owner', 'auth'], function() {

    // kategori
    Route::get('kategori', 'CategoryController@index')->name('kategori');
    Route::get('kategori/tambah', 'CategoryController@tambah');
    Route::post('tambah', 'CategoryController@tambahProses')->name('tambah.kategori');
    Route::get('kategori/edit/{id}', 'CategoryController@edit');
    Route::put('edit/{id}', 'CategoryController@editProses')->name('edit.kategori');
    Route::delete('kategori/{id}', 'CategoryController@hapus')->name('hapus.kategori');

    // produk
    Route::get('produk/', 'ProductController@kategori')->name('produk.kategori');
    Route::get('produk/{category}', 'ProductController@index')->name('produk.index');
    Route::get('produk/tambah/{category}', 'ProductController@tambah')->name('tambah');
    Route::post('tambahProduk/{category}', 'ProductController@prosesTambah')->name('tambahProses');
    Route::get('produk/edit/{category}/{product}', 'ProductController@edit')->name('produk.edit');
    Route::put('produk/{category}/{product}', 'ProductController@editProses')->name('produk.update');
    Route::delete('produk/{category}/{product}', 'ProductController@hapus')->name('produk.hapus');

    // Penjualan
    Route::get('penjualan', 'OrderController@index')->name('order.index');
    Route::get('penjualan/detail/{order}', 'OrderController@show')->name('order.show');

    // Laporan
    Route::get('laporan', 'ReportController@index');
    Route::get('laporan/periode', 'ReportController@periode')->name('laporan.periode');

    // profile
    Route::resource('profile', 'ProfileController');

});


