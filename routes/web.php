<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Rote
Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::resource('kategori', 'App\http\Controllers\Admin\KategoriController');
    Route::resource('produk', 'App\http\Controllers\Admin\ProdukController');
});
