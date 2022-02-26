<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiAccountController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiSubCategoryController;
use App\Http\Controllers\ApiOrdersController;
use App\Http\Controllers\ApiOrdersTransactionController;
use App\Http\Controllers\ApiPromoController;
use App\Http\Controllers\ApiCategoriesController;
use App\Http\Controllers\ApiLocationController;
use App\Http\Controllers\ApiRoleController;
use App\Http\Controllers\ApiMerchantController;

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
Route::get('/dashboard/orders/show_ordered_products/{order_id}',[ApiOrdersController::class, 'show_ordered_products']);
Route::get('/dashboard/orders/show_promos',[ApiOrdersController::class, 'show_promos']);
Route::post('/dashboard/orders/update_status',[ApiOrdersController::class, 'update_status']);
Route::get('/dashboard/orders/editorder/{id}',[ApiOrdersController::class, 'editorder']);
Route::post('/dashboard/orders/insertorder',[ApiOrdersController::class, 'insertorder']);
Route::post('/dashboard/orders/updateorder/{id}',[ApiOrdersController::class, 'updateorder']);
//********************Orders Transaction********************\\
Route::get('/dashboard/orders/showordertrans',[ApiOrdersTransactionController::class, 'showordertransaction']);
Route::get('/dashboard/orders/editordertrans/{id}',[ApiOrdersTransactionController::class, 'editordertransaction']);
Route::post('/dashboard/orders/insertordertrans',[ApiOrdersTransactionController::class, 'insertordertransaction']);
Route::post('/dashboard/orders/updateordertrans/{id}',[ApiOrdersTransactionController::class, 'updateordertransaction']);
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
//********************Role********************\\
Route::get('/dashboard/role',[ApiRoleController::class, 'showrole']);
Route::get('/dashboard/role/edit/{id}',[ApiRoleController::class, 'editrole']);
Route::post('/dashboard/role/insert',[ApiRoleController::class, 'insertrole']);
Route::post('/dashboard/role/update',[ApiRoleController::class, 'updaterole']);
Route::get('/dashboard/role/check',[ApiRoleController::class, 'checkrole']);
//********************Merchant********************\\
Route::get('/dashboard/merchant',[ApiMerchantController::class, 'showmerchant']);
Route::get('/dashboard/merchant/edit/{id}',[ApiMerchantController::class, 'editmerchant']);
Route::post('/dashboard/merchant/insert',[ApiMerchantController::class, 'insertmerchant']);
Route::post('/dashboard/merchant/update',[ApiMerchantController::class, 'updatemerchant']);
Route::get('/dashboard/merchant/check',[ApiMerchantController::class, 'checkmerchant']);