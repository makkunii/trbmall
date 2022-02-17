<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiAccountController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiSubCategoryController;
use App\Http\Controllers\ApiOrdersController;
use App\Http\Controllers\ApiPromoController;
use App\Http\Controllers\ApiCategoriesController;
use App\Http\Controllers\ApiLocationController;
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
Route::get('/dashboard/accounts',[ApiAccountController::class, 'showaccount']);
Route::get('/dashboard/accounts/edit/{id}',[ApiAccountController::class, 'editaccount']);
Route::post('/dashboard/accounts/insert',[ApiAccountController::class, 'insertaccount']);
Route::post('/dashboard/accounts/update',[ApiAccountController::class, 'updateaccount']);
//********************Category********************\\
Route::get('/dashboard/category',[ApiCategoryController::class, 'showcategory']);
Route::get('/dashboard/category/edit/{id}',[ApiCategoryController::class, 'editcategory']);
Route::post('/dashboard/category/insert',[ApiCategoryController::class, 'insertcategory']);
Route::post('/dashboard/category/update',[ApiCategoryController::class, 'updatecategory']);
//********************SubCategory********************\\
Route::get('/dashboard/subcategory',[ApiSubCategoryController::class, 'showsubcategory']);
Route::get('/dashboard/subcategory/view/vcategory',[ApiSubCategoryController::class, 'vshowcategory']);
Route::get('/dashboard/subcategory/edit/{id}',[ApiSubCategoryController::class, 'editsubcategory']);
Route::post('/dashboard/subcategory/insert',[ApiSubCategoryController::class, 'insertsubcategory']);
Route::post('/dashboard/subcategory/update',[ApiSubCategoryController::class, 'updatesubcategory']);
//********************Orders********************\\
Route::get('/dashboard/orders/showorder',[ApiOrdersController::class, 'showorder']);
Route::get('/dashboard/orders/editorder/{id}',[ApiOrdersController::class, 'editorder']);
Route::post('/dashboard/orders/insertorder',[ApiOrdersController::class, 'insertorder']);
Route::post('/dashboard/orders/updateorder/{id}',[ApiOrdersController::class, 'updateorder']);
//********************Promo********************\\
Route::get('/dashboard/promo',[ApiPromoController::class, 'showpromo']);
Route::get('/dashboard/promo/edit/{id}',[ApiPromoController::class, 'editpromo']);
Route::post('/dashboard/promo/insert',[ApiPromoController::class, 'insertpromo']);
Route::post('/dashboard/promo/update',[ApiPromoController::class, 'updatepromo']);
Route::get('/dashboard/promo/check',[ApiPromoController::class, 'checkpromo']);
//********************CATEGOIESZXC********************\\
Route::get('/getcategory',[ApiCategoriesController::class, 'getcategory']);
Route::get('/getsubcategory/{id}',[ApiCategoriesController::class, 'getsubcategory']);
//********************Location********************\\
Route::get('/location/province/all',[ApiLocationController::class, 'getprovince']);
Route::get('/location/city/{province}',[ApiLocationController::class, 'getcity']);
Route::get('/location/brgy/{city}/{province}',[ApiLocationController::class, 'getbrgy']);
