<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Product;
use App\Http\Livewire\Product\Update;
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

Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/', Login::class);
});

// Auth::routes();
Route::group(['middleware' => ['auth']], function(){
    Route::get('/products', Product::class);
    Route::get('/update-product', Update::class)->name('product-update');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', Logout::class)->name('logout');

});
