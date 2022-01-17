<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;


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

Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('home');
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

//PRODUCT
Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('products');
//ACCOUNTS
Route::get('/dashboard/accounts', [DashboardController::class, 'accounts'])->name('accounts');

