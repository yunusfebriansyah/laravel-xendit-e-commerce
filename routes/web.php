<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landing']);

Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{product}', [HomeController::class, 'showProduct']);

Route::get('/carts', [HomeController::class, 'carts'])->middleware('auth');
Route::post('/add-to-cart/{product}', [HomeController::class, 'addToCart'])->middleware('auth');
Route::get('/cart-remove/{cart}', [HomeController::class, 'deleteCart'])->middleware('auth');
Route::post('/buy-from-cart', [HomeController::class, 'buyFormCart'])->middleware('auth');

Route::get('/success/{checkout}', [HomeController::class, 'success'])->middleware('auth');
Route::get('/failure/{checkout}', [HomeController::class, 'failure'])->middleware('auth');

Route::get('/checkouts', [HomeController::class, 'checkouts'])->middleware('auth');

Route::get('/login', [HomeController::class, 'login'])->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->name('login')->middleware('guest');
Route::delete('/logout', [HomeController::class, 'actionLogout'])->middleware('auth');
Route::get('/register', [HomeController::class, 'register'])->middleware('guest');
Route::post('/register', [HomeController::class, 'actionRegister'])->middleware('guest');


