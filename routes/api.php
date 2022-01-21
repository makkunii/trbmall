<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiCategoryController;
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
Route::get('/showproduct',[ApiProductController::class, 'showproduct']);
Route::get('/editproduct/{id}',[ApiProductController::class, 'editproduct']);
Route::post('/insertproduct',[ApiProductController::class, 'insertproduct']);
Route::post('/updateproduct/{id}',[ApiProductController::class, 'updateproduct']);
//********************CATEGORY********************\\
Route::get('/showcategory',[ApiCategoryController::class, 'showcategory']);
