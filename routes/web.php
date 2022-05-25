<?php

use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/create', [ProjectController::class, 'create']);
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit']);
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);

    Route::post('/projects/{project}/tasks', [ProjectTaskController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTaskController::class, 'update']);
});
