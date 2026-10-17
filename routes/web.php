<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;

use Illuminate\Support\Facades\Route;

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


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::resource('/products', ProductController::class)->except(['show']);
    Route::resource('/categories', CategoryController::class)->except(['show']);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/products', [UserProductController::class, 'index']);
    Route::post('/add-to-cart/{id}', [UserProductController::class, 'addToCart']);
    Route::get('/cart', [UserProductController::class, 'viewCart']);
    Route::post('/invoice/save', [InvoiceController::class, 'store']);
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
});