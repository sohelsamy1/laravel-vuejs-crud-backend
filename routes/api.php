<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {

    // Auth (public)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        // Profile
        Route::patch('/profile', [ProfileController::class, 'update']);

        // Get trashed tasks
        Route::get('/tasks/summary', [TaskController::class, 'summary']);
        
        Route::get('/tasks/trashed', [TaskController::class, 'trashed']);
        Route::post('tasks/{id}/restore', [TaskController::class, 'restore']);
        Route::delete('tasks/{id}/force', [TaskController::class, 'forceDelete']);
        Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus']);

         // Task routes
         Route::apiResource('tasks',TaskController::class);

        //filter tasks by status
        Route::get('/tasksfilter', [TaskController::class, 'filter']);
    });
});
