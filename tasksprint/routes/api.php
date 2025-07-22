<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    TasksController
    , ProjectsController

};



Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('tasks', TasksController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('projects', ProjectsController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);
});