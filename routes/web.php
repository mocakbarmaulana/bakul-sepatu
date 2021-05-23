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
    Route::resource('pesanan', 'App\http\Controllers\Admin\PesananController');
});

// Frontend Route
Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('home');
Route::get('/menu', [App\Http\Controllers\FrontendController::class, 'getMenu'])->name('menu');
Route::middleware('member')->group(function(){
    Route::get('/produk/{id}', [App\Http\Controllers\FrontendController::class, 'produkDetail'])->name('produkdetail');
    Route::get('/cart', [App\Http\Controllers\Member\CartController::class, 'showCart'])->name('showcart');
    Route::post('/cart/decrease/{id}', [App\Http\Controllers\Member\CartController::class, 'decreaseCart'])->name('cart.decrease');
    Route::post('/cart/increase/{id}', [App\Http\Controllers\Member\CartController::class, 'increaseCart'])->name('cart.increase');
    Route::post('/cart/delete/{id}', [App\Http\Controllers\Member\CartController::class, 'deleteCart'])->name('cart.delete');
});

// Member Router
Route::prefix('member')->group(function(){
    Route::get('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'getRegister'])->name('member.register');
    Route::get('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'getLogin'])->name('member.login');
    Route::post('/register', [App\Http\Controllers\Member\LoginMemberController::class, 'setRegister'])->name('member.setregister');
    Route::post('/login', [App\Http\Controllers\Member\LoginMemberController::class, 'setLogin'])->name('member.setlogin');
});


// Membeer Router dengan middleware
Route::prefix('member')->middleware('member')->group(function(){
    Route::post('/whislist/add/{id}', [App\Http\Controllers\Member\MemberController::class, 'setWhislist'])->name('member.setwhislit');
    Route::post('/whislist/remove/{id}', [App\Http\Controllers\Member\MemberController::class, 'removeWhislist'])->name('member.rmwhislit');
    Route::post('/cart/add', [App\Http\Controllers\Member\CartController::class, 'addToCart'])->name('member.addtocart');
    Route::post('/checkout', [App\Http\Controllers\Member\MemberController::class, 'setCheckout'])->name('member.setcheckout');
    Route::get('/invoice/{invoice}', [App\Http\Controllers\Member\MemberController::class, 'getInvoice'])->name('member.invoice');
});
