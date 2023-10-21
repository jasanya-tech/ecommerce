<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\AuthController;
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

Route::middleware(['guest'])->group(function () {
    Route::get("/auth/login", [AuthController::class, 'login'])->name('auth.login');
    Route::post("/auth/login", [AuthController::class, 'loginProcess'])->name('auth.login.process');
    Route::get("/auth/register", [AuthController::class, 'register'])->name('auth.register');
    Route::post("/auth/register", [AuthController::class, 'registerProcess'])->name('auth.register.process');
});

Route::middleware(['admin'])->group(function () {
    Route::get("/admin", [Dashboard::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get("/auth/logout", [AuthController::class, 'logout'])->name('auth.logout');
});
