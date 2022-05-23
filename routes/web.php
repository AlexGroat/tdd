<?php

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
});
