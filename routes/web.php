<?php

use App\Http\Controllers\pages\TaskController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;

// Controllers
use App\Http\Controllers\pages\ProfileController;
use App\Http\Controllers\pages\UserController;
use App\Http\Controllers\pages\ClientController;
use App\Http\Controllers\pages\ModuleController;

// Main Page Route
Route::get('/', [HomePage::class, 'index'])->name('homepage');

// Sistema
Route::get('/users', [UserController::class, 'index'])->name('sys-user');
Route::get('/profiles', [ProfileController::class, 'index'])->name('sys-profile');
Route::get('/clients', [ClientController::class, 'index'])->name('sys-client');
Route::get('/modules', [ModuleController::class, 'index'])->name('sys-module');

// Support
//       → Tasks
Route::get('/tasks', [TaskController::class, 'tasks'])->name('sup-tasks');
Route::get('/task/create', [TaskController::class, 'taskCreate'])->name('sup-task-create');
Route::post('/task/create', [TaskController::class, 'taskCreateAction']);
Route::get('/task/update/{id}', [TaskController::class, 'taskUpdate'])->name('sup-task-update');
Route::post('/task/update/{id}', [TaskController::class, 'taskUpdateAction']);
//               → Comments
Route::post('/task/comment', [TaskController::class, 'commentAction'])->name('sup-comment');
Route::post('/task/comment/update', [TaskController::class, 'commentUpdate'])->name('sup-comment-update');
Route::post('/task/comment/delete/{id}', [TaskController::class, 'commentDelete'])->name('sup-comment-delete');
//               → Roadmap
Route::get('/task/roadmap', [TaskController::class, 'roadmap'])->name('sup-roadmap');
Route::post('/task/roadmap', [TaskController::class, 'roadmapAction']);
Route::post('/task/roadmap/update', [TaskController::class, 'roadmapUpdate'])->name('sup-roadmap-update');
Route::post('/task/roadmap/delete/{id}', [TaskController::class, 'roadmapDelete'])->name('sup-roadmap-delete');
