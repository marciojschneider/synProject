<?php

use App\Http\Controllers\pages\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;

// Main Page Route
Route::get('/', [HomePage::class, 'index'])->name('pages-home');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// Sistema
Route::get('/users', [UserController::class, 'list'])->name('sys-user');
