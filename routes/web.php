<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('register', function () {
    return view('register');
});
Route::post('login', [UserController::class, 'login'])->name('user.login');
Route::post('register', [UserController::class, 'register'])->name('user.register');

Route::middleware(['auth'])->group(function () {
    Route::get('product', [ProductController::class, 'products']);
    Route::post('search-product', [ProductController::class, 'searchproduct'])->name('search.product');
    Route::post('add-product', [ProductController::class, 'addproduct'])->name('add.product');
    Route::post('edit-product/{id}', [ProductController::class, 'editproduct'])->name('edit.product');
    Route::get('delete-product/{id}', [ProductController::class, 'deleteproduct'])->name('delete.product');
    Route::get('transaction',[TransactionController::class,'gettransaction']);
    Route::post('search-transaction',[TransactionController::class,'searchtranscation'])->name('search.transaction');
});


