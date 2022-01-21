<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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


// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// PAPA WENDEL LIBRE MOKO
// AKO RIN LIBRE MO WENDELL



Route::get('/login', function () {
    return view('login');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard/products', function () {
    return view('dashboard/products');
 });

 Route::get('/dashboard/accounts', function () {
    return view('dashboard/accounts');
 });


 //LOGIN
Route::get('/login', [LoginController::class, 'login'])->name('login');

/*-------------------------------------
DASHBOARD
--------------------------------------*/
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

//PRODUCT
Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('products');
//ACCOUNTS
Route::get('/dashboard/accounts', [DashboardController::class, 'accounts'])->name('accounts');

Route::get('/', [HomeController::class, 'index'])->name('home');
