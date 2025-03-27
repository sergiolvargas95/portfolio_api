<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('technologies', TechnologyController::class);
});
