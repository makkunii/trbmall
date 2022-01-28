<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\DashboardController;


use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

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

 //LOGIN
Route::get('/login', [LoginController::class, 'login'])->name('login');

/*-------------------------------------
DASHBOARD
--------------------------------------*/
//Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
//PRODUCT
Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('products');
Route::post('/dashboard/products/insert', [DashboardController::class, 'insertproduct'])->name('insertproduct');
Route::post('/dashboard/products/update', [DashboardController::class, 'updateproduct'])->name('updateproduct');


//ACCOUNTS
Route::get('/dashboard/accounts', [DashboardController::class, 'accounts'])->name('accounts');

/*-------------------------------------
TRB MALL
--------------------------------------*/
//LANDING PAGE - HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
// CART
Route::get('/mall/cart', [CartController::class, 'cart'])->name('cart');

// Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
