<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::apiResource('tasks', TaskController::class);
Route::patch('tasks/{id}/toggle', [TaskController::class, 'toggleComplete']);
Route::get('tasks-statistics', [TaskController::class, 'statistics']);
