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

// Admin Rote
Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::resource('kategori', 'App\http\Controllers\Admin\KategoriController');
    Route::resource('produk', 'App\http\Controllers\Admin\ProdukController');
});

// Frontend Route
Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('home');
Route::get('/menu', [App\Http\Controllers\FrontendController::class, 'getMenu'])->name('menu');
Route::get('/produk/{id}', [App\Http\Controllers\FrontendController::class, 'produkDetail'])->name('produkdetail');

// Member Router
Route::prefix('member')->group(function(){
    Route::get('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'getRegister'])->name('member.register');
    Route::get('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'getLogin'])->name('member.login');
    Route::post('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'setRegister'])->name('member.setregister');
    Route::post('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'setLogin'])->name('member.setlogin');
});


// Membeer Router dengan middleware
Route::prefix('member')->middleware('member')->group(function(){
    Route::get('/test', function() {
        return "Hello World";
    })->name('member.test');
});
