<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AboutController;

use App\Http\Controllers\LiveStreamController;
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

// 首页路由，所有用户都可以访问
Route::view('/', 'welcome');
Auth::routes();

// 用户首页，需要登录后访问
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/aboutUs', 'aboutUs')->name('aboutUs');
Route::view('/privacy', 'privacyPolicy')->name('privacy');
Route::view('/terms', 'terms&conditions')->name('terms');
Route::view('/myAccount', 'myAccount')->name('myAccount');
Route::get('/myAccount/updateUser/{user}', [UserController::class, 'showUpdate'])->name('user.edit.show');
Route::post('/myAccount/updateUser', [UserController::class, 'updateUser'])->name('user.edit');

// 管理员路由
Route::get('/products/show',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.destroy');

// 所有用户都可以访问的路由
Route::get('/products', [ProductController::class, 'showByCategory'])->name('products.showByCategory');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/cart', [CartController::class, 'productCart'])->name('cart');
Route::post('/product/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-shopping-cart', [CartController::class, 'updateCart'])->name('update.shopping.cart');
Route::delete('/delete-cart-product', [CartController::class, 'deleteCart'])->name('delete.cart.product');
Route::get('/checkout', [OrderController::class, 'checkoutProduct']);
Route::POST('/checkout', [OrderController::class, 'createOrder']);
Route::get('/orderHistory', [OrderController::class, 'showOrder'])->name('orderHistory');
Route::view('/thankyou', 'thankyou');
Route::view('/createLive', 'createLive');
Route::post('/save-live-stream', [LiveStreamController::class, 'save'])->name('liveStream.save');
Route::get('/aboutUs', [AboutController::class, 'index'])->name('aboutUs');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::match(['get', 'post'],'botman',[BotManController::class,'handle'])->name('');
Route::view('/match', 'match');