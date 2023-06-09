<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SaucesController;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [UserController::class, 'loginView'])->name('loginView');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/table/{table}', [TablesController::class, 'show'])->name('userTable');
Route::post('/table/{table}', [OrdersController::class, 'store'])->name('ordersStore');
Route::delete('/table/{table}', [OrdersController::class, 'destroy'])->name('ordersDestroy');
Route::post('/table/{table}/order', [OrdersController::class, 'update'])->name('orderUpdate');

Route::prefix('/admin')->name('admin.')->middleware('admin')->group(function(){
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserController::class, 'settingsPost'])->name('settingsPost');
    Route::get('', [OrdersController::class, 'index']);
    Route::get('/orders/edit', [OrdersController::class, 'edit'])->name('ordersEdit');
    Route::post('orders/{tableId}/edit/', [OrdersController::class, 'orderPaid'])->name('orderPaid');
    Route::resource('/orders', OrdersController::class);
    Route::resource('productcategories', ProductCategoriesController::class);
    Route::resource('ingredients', IngredientsController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('tables', TablesController::class);
    Route::resource('sauces', SaucesController::class);
});
