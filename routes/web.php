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
//       → Users
Route::get('/users', [UserController::class, 'index'])->name('sys-user');

//       → Clients
Route::get('/clients', [ClientController::class, 'clients'])->name('sys-clients');
Route::get('/client/create', [ClientController::class, 'clientCreate'])->name('sys-client-create');
Route::post('/client/create', [ClientController::class, 'clientCreateAction']);
Route::get('/client/update/{id}', [ClientController::class, 'clientUpdate'])->name('sys-client-update');
Route::post('/client/update/{id}', [ClientController::class, 'clientUpdateAction']);
Route::post('/client/delete/{id}', [ClientController::class, 'clientDelete'])->name('sys-client-delete');

//       → Modules
Route::get('/modules', [ModuleController::class, 'modules'])->name('sys-modules');
Route::get('/module/create', [ModuleController::class, 'moduleCreate'])->name('sys-module-create');
Route::post('/module/create', [ModuleController::class, 'moduleCreateAction']);
Route::get('/module/update/{id}', [ModuleController::class, 'moduleUpdate'])->name('sys-module-update');
Route::post('/module/update/{id}', [ModuleController::class, 'moduleUpdateAction']);
Route::post('/module/delete/{id}', [ModuleController::class, 'moduleDelete'])->name('sys-module-delete');

//       → Profiles
Route::get('/profiles', [ProfileController::class, 'profiles'])->name('sys-profiles');
Route::get('/profile/create', [ProfileController::class, 'profileCreate'])->name('sys-profile-create');
Route::post('/profile/create', [ProfileController::class, 'profileCreateAction']);
Route::get('/profile/update/{id}', [ProfileController::class, 'profileUpdate'])->name('sys-profile-update');
Route::post('/profile/update/{id}', [ProfileController::class, 'profileUpdateAction']);
Route::post('/profile/delete/{id}', [ProfileController::class, 'profileDelete'])->name('sys-profile-delete');

// Support
//       → Tasks
Route::get('/tasks', [TaskController::class, 'tasks'])->name('sup-tasks');
Route::get('/task/create', [TaskController::class, 'taskCreate'])->name('sup-task-create');
Route::post('/task/create', [TaskController::class, 'taskCreateAction']);
Route::get('/task/update/{id}', [TaskController::class, 'taskUpdate'])->name('sup-task-update');
Route::post('/task/update/{id}', [TaskController::class, 'taskUpdateAction']);
Route::post('/task/delete/{id}', [TaskController::class, 'taskDelete'])->name('sup-task-delete');
//               → Comments
Route::post('/task/comment', [TaskController::class, 'commentAction'])->name('sup-comment');
Route::post('/task/comment/update', [TaskController::class, 'commentUpdate'])->name('sup-comment-update');
Route::post('/task/comment/delete/{id}', [TaskController::class, 'commentDelete'])->name('sup-comment-delete');
//               → Roadmap
Route::get('/task/roadmap', [TaskController::class, 'roadmap'])->name('sup-roadmap');
Route::post('/task/roadmap', [TaskController::class, 'roadmapAction']);
Route::post('/task/roadmap/update', [TaskController::class, 'roadmapUpdate'])->name('sup-roadmap-update');
Route::post('/task/roadmap/delete/{id}', [TaskController::class, 'roadmapDelete'])->name('sup-roadmap-delete');
