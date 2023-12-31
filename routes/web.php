<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
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
    Route::get("/profile", [ProfileController::class, 'index'])->name('profile.index');
    Route::put("/profile/{user}", [ProfileController::class, 'update'])->name('profile.update');
    Route::put("/profile/image/{user}", [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::put("/profile/password/{user}", [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    Route::get("/auth/logout", [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('/cart{product}', [CartController::class, 'store'])->name('user.cart.store');
    Route::put('/cart{cart}', [CartController::class, 'update'])->name('user.cart.update');
    Route::delete('/cart{cart}', [CartController::class, 'destroy'])->name('user.cart.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('user.order.index');
    Route::get('/order/show/{order}', [OrderController::class, 'show'])->name('user.order.show');
    Route::get('/order/{product}', [OrderController::class, 'create'])->name('user.order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('user.order.store');
    Route::post('/order/from-cart', [OrderController::class, 'storeFromCart'])->name('user.order.store.from.cart');
    Route::put('/order/update/payment/{order}', [OrderController::class, 'uploadPaymentProof'])->name('user.order.update.paymentProof');
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

    Route::resource('/admin/master/order', AdminOrderController::class);
    Route::get('/admin/master/order/{order}', [AdminOrderController::class, 'show'])->name('order.show');

    Route::get('/admin/report/pengiriman', [LaporanController::class, 'indexPengiriman'])->name('report.index.pengiriman');
    Route::get('/admin/report/transaction', [LaporanController::class, 'indexTransaction'])->name('report.index.transaction');
    Route::get('/admin/report/transaction/{type}', [ExportController::class, 'exportTransaction'])->name('report.print.transaction');
});
