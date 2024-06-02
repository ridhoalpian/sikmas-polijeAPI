<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [Controller::class, 'register']);

Route::post('/login', [Controller::class, 'loginApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user-data', [Controller::class, 'getUserData']);
});

Route::post('change-password', [Controller::class, 'changePassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('update-user', [Controller::class, 'update']);
});

Route::middleware('auth:sanctum')->post('validate-old-password', [Controller::class, 'validateOldPassword']);

Route::post('prestasi', [PrestasiController::class, 'store']);
Route::get('prestasi', [PrestasiController::class, 'index']);
Route::post('prestasi/{idprestasi}', [PrestasiController::class, 'updatePrestasi']);

Route::get('proker', [ProkerController::class, 'index']);
Route::post('proker', [ProkerController::class, 'store']);
Route::post('proker/{id}', [ProkerController::class, 'updateLampiranProker']);
