<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'API working']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('v1')->group(function() {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('technologies', TechnologyController::class);
    Route::apiResource('users', UserController::class);
});

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [ AuthController::class, 'loginUser' ]);

