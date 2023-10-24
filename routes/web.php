<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as ControllersProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get("/product/{product}", [ControllersProductController::class, 'show'])->name('product.user.show');
Route::get("/product", [ControllersProductController::class, 'index'])->name('product.user.index');
Route::get("/product/category/{category}", [ControllersProductController::class, 'indexByCategory'])->name('product.user.index.by.category');

Route::middleware(['auth'])->group(function () {
    Route::get("/auth/logout", [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('/cart{product}', [CartController::class, 'store'])->name('user.cart.store');
    Route::put('/cart{cart}', [CartController::class, 'update'])->name('user.cart.update');
    Route::delete('/cart{cart}', [CartController::class, 'destroy'])->name('user.cart.destroy');

    Route::get('/order/{product}', [OrderController::class, 'create'])->name('user.order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('user.order.store');
    Route::post('/order/from-cart', [OrderController::class, 'storeFromCart'])->name('user.order.store.from.cart');
});

Route::middleware(['guest'])->group(function () {
    Route::get("/auth/login", [AuthController::class, 'login'])->name('auth.login');
    Route::post("/auth/login", [AuthController::class, 'loginProcess'])->name('auth.login.process');
    Route::get("/auth/register", [AuthController::class, 'register'])->name('auth.register');
    Route::post("/auth/register", [AuthController::class, 'registerProcess'])->name('auth.register.process');
});

Route::middleware(['admin'])->group(function () {
    Route::get("/admin", [Dashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/master/category', CategoryController::class);

    Route::resource('/admin/master/product', ProductController::class);
    Route::get('/admin/master/product/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::resource('/admin/master/user', UserController::class);
    Route::get('/admin/master/user/{user}', [UserController::class, 'show'])->name('user.show');
});
