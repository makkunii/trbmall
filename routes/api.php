<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiAccountController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiSubCategoryController;
use App\Http\Controllers\ApiOrdersController;
use App\Http\Controllers\ApiPromoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//********************PRODUCT********************\\
Route::get('/dashboard/products',[ApiProductController::class, 'showproduct']);
Route::get('/dashboard/products/edit/{id}',[ApiProductController::class, 'editproduct']);
Route::post('/dashboard/products/insert',[ApiProductController::class, 'insertproduct']);
Route::post('/dashboard/products/update',[ApiProductController::class, 'updateproduct']);
//********************Account********************\\
Route::get('/showaccount',[ApiAccountController::class, 'showaccount']);
Route::get('/editaccount/{id}',[ApiAccountController::class, 'editaccount']);
Route::post('/insertaccount',[ApiAccountController::class, 'insertaccount']);
Route::post('/updateaccount/{id}',[ApiAccountController::class, 'updateaccount']);
//********************Category********************\\
Route::get('/showcategory',[ApiCategoryController::class, 'showcategory']);
Route::get('/editcategory/{id}',[ApiCategoryController::class, 'editcategory']);
Route::post('/insertcategory',[ApiCategoryController::class, 'insertcategory']);
Route::post('/updatecategory/{id}',[ApiCategoryController::class, 'updatecategory']);
//********************SubCategory********************\\
Route::get('/showsubcategory',[ApiSubCategoryController::class, 'showsubcategory']);
Route::get('/editsubcategory/{id}',[ApiSubCategoryController::class, 'editsubcategory']);
Route::post('/insertsubcategory',[ApiSubCategoryController::class, 'insertsubcategory']);
Route::post('/updatesubcategory/{id}',[ApiSubCategoryController::class, 'updatesubcategory']);
//********************Orders********************\\
Route::get('/showorder',[ApiOrdersController::class, 'showorder']);
Route::get('/editorder/{id}',[ApiOrdersController::class, 'showorder']);
Route::post('/insertorder',[ApiOrdersController::class, 'insertorder']);
Route::post('/updateorder/{id}',[ApiOrdersController::class, 'updateorder']);
//********************Promo********************\\
Route::get('/showpromo',[ApiPromoController::class, 'showpromo']);
Route::get('/editpromo/{id}',[ApiPromoController::class, 'editpromo']);
Route::post('/insertpromo',[ApiPromoController::class, 'insertpromo']);
Route::post('/updatepromo/{id}',[ApiPromoController::class, 'updatepromo']);