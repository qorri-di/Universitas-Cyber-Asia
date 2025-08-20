<?php

use App\Http\Controllers\ApiGatewayController;
use Illuminate\Support\Facades\Route;

// Tangkap semua request ke /api/ apapun, minimal /api/x
Route::any('{any}', [ApiGatewayController::class, 'handle'])
    ->where('any', '.*');
