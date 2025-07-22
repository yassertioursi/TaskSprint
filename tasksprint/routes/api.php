<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    TasksController,
    ProjectsController
};

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:api')->group(function () {
    // IMPORTANT: Put specific routes BEFORE dynamic routes
    Route::get('/tasks/counts', [TasksController::class, 'getCounts']);

    // Task CRUD routes
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::put('/tasks/{task}', [TasksController::class, 'update']);
    Route::delete('/tasks/{task}', [TasksController::class, 'destroy']);

    // Project routes
    Route::apiResource('projects', ProjectsController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);
});