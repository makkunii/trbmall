<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AccountsController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\PromoController;
use App\Http\Controllers\Web\SubCategoryController;

use App\Http\Controllers\Web\CheckoutController;
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
Route::get('/dashboard/products', [ProductsController::class, 'products'])->name('products');
Route::get('/dashboard/products/edit', [ProductsController::class, 'editproduct'])->name('editproduct');
Route::post('/dashboard/products/insert', [ProductsController::class, 'insertproduct'])->name('insertproduct');
Route::post('/dashboard/products/update', [ProductsController::class, 'updateproduct'])->name('updateproduct');
//ACCOUNT
Route::get('/dashboard/accounts', [AccountsController::class, 'accounts'])->name('accounts');
Route::get('/dashboard/accounts/edit', [AccountsController::class, 'editaccount'])->name('editaccount');
Route::post('/dashboard/accounts/insert', [AccountsController::class, 'insertaccount'])->name('insertaccount');
Route::post('/dashboard/accounts/update', [AccountsController::class, 'updateaccount'])->name('updateaccount');
//CATEGORY
Route::get('/dashboard/category', [CategoryController::class, 'category'])->name('category');
Route::get('/dashboard/category/edit', [CategoryController::class, 'editcategory'])->name('editcategory');
Route::post('/dashboard/category/insert', [CategoryController::class, 'insertcategory'])->name('insertcategory');
Route::post('/dashboard/category/update', [CategoryController::class, 'updatecategory'])->name('updatecategory');


//SUB CATEGORY
Route::get('/dashboard/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
Route::get('/dashboard/subcategory/view/vcategory', [SubCategoryController::class, 'vcategory'])->name('vcategory');
Route::get('/dashboard/subcategory/edit', [SubCategoryController::class, 'editsubcategory'])->name('editsubcategory');
Route::post('/dashboard/subcategory/insert', [SubCategoryController::class, 'insertsubcategory'])->name('insertsubcategory');
Route::post('/dashboard/subcategory/update', [SubCategoryController::class, 'updatesubcategory'])->name('updatesubcategory');

//PROMO
Route::get('/dashboard/promo', [PromoController::class, 'promo'])->name('promo');
Route::get('/dashboard/promo/edit', [PromoController::class, 'editpromo'])->name('editcpromo');
Route::post('/dashboard/promo/insert', [PromoController::class, 'insertpromo'])->name('insertpromo');
Route::post('/dashboard/promo/update', [PromoController::class, 'updatepromo'])->name('updatepromo');

/*-------------------------------------
TRB MALL
--------------------------------------*/
//LANDING PAGE - HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
//CHECKOUT
Route::get('/mall/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
// CART
Route::get('/mall/cart', [CartController::class, 'cart'])->name('cart');

// Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('/cartCheckout',[CartController::class, 'checkoutCart'])->name('checkoutCart');

/*-------------------------------------
CLEAR CACHE
--------------------------------------*/
Route::get('/clear-cache', function(){
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    return 'Clear cache finished!';
});
