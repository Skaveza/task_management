<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// API routes for tasks
Route::apiResource('tasks', TaskController::class);
Route::patch('tasks/{id}/toggle', [TaskController::class, 'toggleComplete']);
Route::get('tasks-statistics', [TaskController::class, 'statistics']);