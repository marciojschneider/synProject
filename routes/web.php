<?php

use App\Http\Controllers\pages\ProcessController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pages\HomePage;

// Controllers
use App\Http\Controllers\pages\ProfileController;
use App\Http\Controllers\pages\UserController;
use App\Http\Controllers\pages\ClientController;
use App\Http\Controllers\pages\ProfillePermissionController;
use App\Http\Controllers\pages\TaskController;
use App\Http\Controllers\pages\HarvestController;
use App\Http\Controllers\pages\PlantingMethodController;

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
Route::get('/profile/permissions', [ProfillePermissionController::class, 'profilePermissions'])->name('sys-permissions');
Route::get('/profile/permission/create', [ProfillePermissionController::class, 'profilePermissionsCreate'])->name('sys-permission-create');
Route::post('/profile/permission/create', [ProfillePermissionController::class, 'profilePermissionsCreateAction']);
Route::get('/profile/permission/update/{id}', [ProfillePermissionController::class, 'profilePermissionsUpdate'])->name('sys-permission-update');
Route::post('/profile/permission/update/{id}', [ProfillePermissionController::class, 'profilePermissionsUpdateAction']);
Route::post('/profile/permission/delete/{id}', [ProfillePermissionController::class, 'profilePermissionsDelete'])->name('sys-permission-delete');
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

// Structure
//               → Harvest (Safra)
Route::get('/harvests', [HarvestController::class, 'harvests'])->name('structure-harvests');
Route::get('/harvest/create', [HarvestController::class, 'harvestCreate'])->name('structure-harvest-create');
Route::post('/harvest/create', [HarvestController::class, 'harvestCreateAction']);
Route::get('/harvest/update/{id}', [HarvestController::class, 'harvestUpdate'])->name('structure-harvest-update');
Route::post('/harvest/update/{id}', [HarvestController::class, 'harvestUpdateAction']);
Route::post('/harvest/delete/{id}', [HarvestController::class, 'harvestDelete'])->name('structure-harvest-delete');
//               → Organização
//               → Cultura

// Cultivo
//               → Métodos
Route::get('/cultive/methods', [PlantingMethodController::class, 'plantingMethods'])->name('cultive-methods');
Route::get('/cultive/method/create', [PlantingMethodController::class, 'plantingMethodCreate'])->name('cultive-method-create');
Route::post('/cultive/method/create', [PlantingMethodController::class, 'plantingMethodCreateAction']);
Route::get('/cultive/method/update/{id}', [PlantingMethodController::class, 'plantingMethodUpdate'])->name('cultive-method-update');
Route::post('/cultive/method/update/{id}', [PlantingMethodController::class, 'plantingMethodUpdateAction']);
Route::post('/cultive/method/delete/{id}', [PlantingMethodController::class, 'plantingMethodDelete'])->name('cultive-method-delete');
//               → Hora Máquina
//               → Processo Etapas
Route::get('/cultive/processes', [ProcessController::class, 'processes'])->name('cultive-processes');
Route::get('/cultive/process/create', [ProcessController::class, 'processCreate'])->name('cultive-process-create');
Route::post('/cultive/process/create', [ProcessController::class, 'processCreateAction']);
Route::get('/cultive/process/update/{id}', [ProcessController::class, 'processUpdate'])->name('cultive-process-update');
Route::post('/cultive/process/update/{id}', [ProcessController::class, 'processUpdateAction']);
Route::post('/cultive/process/delete/{id}', [ProcessController::class, 'processDelete'])->name('cultive-process-delete');
