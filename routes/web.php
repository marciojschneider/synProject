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
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// Sistema
Route::get('/users', [UserController::class, 'index'])->name('sys-user');
Route::get('/profiles', [ProfileController::class, 'index'])->name('sys-profile');
Route::get('/clients', [ClientController::class, 'index'])->name('sys-client');
Route::get('/modules', [ModuleController::class, 'index'])->name('sys-module');

// Suporte
Route::get('/tasks', [TaskController::class, 'index'])->name('sup-task');
Route::get('/roadmap', [TaskController::class, 'roadmap'])->name('sup-roadmap');
