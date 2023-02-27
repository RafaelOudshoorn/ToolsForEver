<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\CategoryController;
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
    return view('index');
});
Route::get('/product/aanmaken', function () {
    return view('product.create');
});
Route::get('/winkelwagen', function () {
    return view('winkelwagen');
});
Route::get('/product/{id}', function () {
    return view('product.show');
});
Route::get('admin/product/{id}', function () {
    return view('product.update');
});
Route::get('/order', function () {
    return view('order/create');
});
Route::get('/order/proceed', function () {
    return view('order/show');
});
Auth::routes();

Route::get('/', [CRUDController::class, 'index']);
Route::post('/', [CRUDController::class, 'index']);

Route::get('/product/aanmaken', [CategoryController::class, 'index']);
Route::post('/product/aanmaken', [CRUDController::class, 'store']);

Route::get('/product/{id}', [CRUDController::class, 'show']);
Route::post('/add/product/{id}', [CRUDController::class, 'addToWinkelwagen']);

Route::get('/admin/product/{id}', [CRUDController::class, 'showForEdit']);
Route::post('/admin/product/{id}', [CRUDController::class, 'update']);

Route::get('/winkelwagen', [CRUDController::class, 'showForWinkelwagen']);
Route::post('/update/winkelwagen/{id}', [CRUDController::class, 'updateWTotal']);
Route::post('/delete/winkelwagen/{id}', [CRUDController::class, 'destroyProductFromShopping_card']);

Route::post('/delete/product/{id}', [CRUDController::class, 'destroy']);

Route::get('/order', [OrdersController::class, 'index']);
Route::get('/order/proceed',[OrdersController::class, 'orderView']);
Route::post('/create/order', [OrdersController::class, 'store']);
Route::post('/update/order/{$id}', [OrdersController::class, 'edit']);