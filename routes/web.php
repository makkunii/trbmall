<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\DashboardController;



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
//ACCOUNTS
Route::get('/dashboard/accounts', [DashboardController::class, 'accounts'])->name('accounts');

/*-------------------------------------
TRB MALL
--------------------------------------*/
//LANDING PAGE - HOME
Route::get('/', [HomeController::class, 'index'])->name('home');
// CART
Route::get('/mall/cart', [CartController::class, 'cart'])->name('cart');
