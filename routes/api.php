<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloodTypeController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok']));
Route::get('/genders', [GenderController::class, 'all']);
Route::get('/blood-types', [BloodTypeController::class, 'all']);
Route::get('/users/{id}/exists', [AuthController::class, 'userExists']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login-publico', [AuthController::class, 'publicLogin']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [RegisterController::class, 'update']);
    Route::delete('/user', [RegisterController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
