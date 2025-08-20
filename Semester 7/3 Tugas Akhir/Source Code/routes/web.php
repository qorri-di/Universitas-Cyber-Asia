<?php

use App\Http\Controllers\ApiGatewayController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EdrController;
use App\Http\Controllers\Dashboard\MicroserviceController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ZtaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::prefix('microservice')->group(function () {
        Route::get('/', [MicroserviceController::class, 'index'])->name('microservice');
        Route::post('/create', [MicroserviceController::class, 'create'])->name('microservice.create');
        Route::get('/log-activity', [MicroserviceController::class, 'log'])->name('microservice.log');
    });
    Route::prefix('edr')->group(function () {
        Route::get('/', [EdrController::class, 'index'])->name('edr');
        Route::get('/log-activity', [EdrController::class, 'log'])->name('edr.log');
    });
    Route::prefix('zta')->group(function () {
        Route::get('/zta', [ZtaController::class, 'index'])->name('zta');
        Route::get('/log-activity', [EdrController::class, 'log'])->name('zta.log');
    });
    Route::prefix('user')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
    });
});
