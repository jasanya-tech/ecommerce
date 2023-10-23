<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::middleware(['auth'])->group(function () {
});

Route::middleware(['auth'])->group(function () {
    Route::get("/auth/logout", [AuthController::class, 'logout'])->name('auth.logout');
});
