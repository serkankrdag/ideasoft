<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductsController::class, 'productsList'])->name('productsList');
Route::get('/customers', [CustomersController::class, 'customersList'])->name('customersList');

Route::get('/orders', [OrdersController::class, 'ordersList'])->name('ordersList');
Route::post('/ordersAdd', [OrdersController::class, 'ordersAdd'])->name('ordersAdd');
Route::post('/ordersDelete', [OrdersController::class, 'ordersDelete'])->name('ordersDelete');
// Route::get('/products', [YourController::class, 'productsList'])->middleware('your-middleware')->name('productsList');
