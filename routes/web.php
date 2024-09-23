<?php
use Livewire\Livewire;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Controllers
use App\Http\Controllers\pages\HomePage;
//       → System
use App\Http\Controllers\pages\Sys\ClientController;
use App\Http\Controllers\pages\Sys\ProfileController;
use App\Http\Controllers\pages\Sys\UserController;
use App\Http\Controllers\pages\Sys\SidebarController;
//                → Security
use App\Http\Controllers\pages\Sys\Security\UserProfileController;
use App\Http\Controllers\pages\Sys\Security\ProfillePermissionController;
use App\Http\Controllers\pages\Sys\Security\ClosureModuleController;

//       → Structure
use App\Http\Controllers\pages\Structure\FarmController;
use App\Http\Controllers\pages\Structure\OrganizationController;
use App\Http\Controllers\pages\Structure\LocalityController;
use App\Http\Controllers\pages\Structure\FieldController;
use App\Http\Controllers\pages\Structure\SectionController;
use App\Http\Controllers\pages\Structure\SectorController;

//       → Cultive
use App\Http\Controllers\pages\Cultive\CultureController;
use App\Http\Controllers\pages\Cultive\PlantingMethodController;
use App\Http\Controllers\pages\Cultive\ProcessController;
use App\Http\Controllers\pages\Cultive\GroupController;
use App\Http\Controllers\pages\Cultive\VarietyController;
use App\Http\Controllers\pages\Cultive\MachineHourController;

//       → Harvest
use App\Http\Controllers\pages\Harvest\HarvestController;
use App\Http\Controllers\pages\Harvest\HarvestConfigurationController;

//       → Support
use App\Http\Controllers\pages\Support\TaskController;
use App\Http\Controllers\pages\Support\RoadmapController;

//       → TESTANDO
use App\Http\Controllers\pages\Boarding\BoardingController;

// Livewire Adjusts
Livewire::setUpdateRoute(function ($handle) {
  return Route::post('/synProject/public/livewire/update', $handle);
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction']);

Route::middleware(['auth'])->group(function () {
  // Authentication
  Route::get('/select-client', [AuthController::class, 'selectClient'])->name('select-client');
  Route::post('/select-client', [AuthController::class, 'selectClientAction']);
  Route::get('/select-profile', [AuthController::class, 'selectProfile'])->name('select-profile');
  Route::post('/select-profile', [AuthController::class, 'selectProfileAction']);

  Route::get('/no-permission', function () {
    return view('content.pages.errors.no-permission');
  })->name('no-permission');

  route::get('/exit', function () {
    return redirect()->route('login');
  })->name('exit');
});

Route::middleware(['auth', 'canAccess'])->group(function () {
  // Homepage
  Route::get('/', [HomePage::class, 'index'])->name('homepage');

  // System
  //       → Users
  Route::get('/sys/users', [UserController::class, 'users'])->name('sys-users');
  Route::get('/sys/users/create', [UserController::class, 'userCreate'])->name('sys-user-create');
  Route::get('/sys/users/update/{id}', [UserController::class, 'userUpdate'])->name('sys-user-update');
  //       → Clients
  Route::get('/sys/clients', [ClientController::class, 'clients'])->name('sys-clients');
  Route::get('/sys/clients/create', [ClientController::class, 'clientCreate'])->name('sys-client-create');
  Route::get('/sys/clients/update/{id}', [ClientController::class, 'clientUpdate'])->name('sys-client-update');
  //       → Profiles
  Route::get('/sys/profiles', [ProfileController::class, 'profiles'])->name('sys-profiles');
  Route::get('/sys/profiles/create', [ProfileController::class, 'profileCreate'])->name('sys-profile-create');
  Route::get('/sys/profiles/update/{id}', [ProfileController::class, 'profileUpdate'])->name('sys-profile-update');
  //       → Sidebars
  Route::get('/sys/sidebars', [SidebarController::class, 'sidebars'])->name('sys-sidebars');
  Route::get('/sys/sidebars/create', [SidebarController::class, 'sidebarCreate'])->name('sys-sidebar-create');
  Route::get('/sys/sidebars/update/{id}', [SidebarController::class, 'sidebarUpdate'])->name('sys-sidebar-update');
  //       → Security
  //                  → Permissions
  Route::get('/sys/p-permissions', [ProfillePermissionController::class, 'ProfilePermissions'])->name('sys-sec-permissions');
  Route::get('/sys/p-permissions/create', [ProfillePermissionController::class, 'ProfilePermissionCreate'])->name('sys-sec-permission-create');
  Route::get('/sys/p-permissions/update/{id}', [ProfillePermissionController::class, 'ProfilePermissionUpdate'])->name('sys-sec-permission-update');
  //                  → User Profiles
  Route::get('/sys/u-profiles', [UserProfileController::class, 'userProfiles'])->name('sys-sec-u-ps');
  Route::get('/sys/u-profiles/create', [UserProfileController::class, 'userProfileCreate'])->name('sys-sec-u-p-create');
  Route::get('/sys/u-profiles/update/{id}', [UserProfileController::class, 'userProfileUpdate'])->name('sys-sec-u-p-update');
  //                  → Closure Modules
  Route::get('/sys/closure-modules', [ClosureModuleController::class, 'closureModules'])->name('sys-sec-closures');
  Route::get('/sys/closure-modules/create', [ClosureModuleController::class, 'closureModuleCreate'])->name('sys-sec-closure-create');
  Route::get('/sys/closure-modules/update/{id}', [ClosureModuleController::class, 'closureModuleUpdate'])->name('sys-sec-closure-update');

  // Structure
  //       → Organization
  Route::get('/structure/organizations', [OrganizationController::class, 'organizations'])->name('structure-organizations');
  Route::get('/structure/organizations/create', [OrganizationController::class, 'organizationCreate'])->name('structure-organization-create');
  Route::get('/structure/organizations/update/{id}', [OrganizationController::class, 'organizationUpdate'])->name('structure-organization-update');
  //       → Farm
  Route::get('/structure/farms', [FarmController::class, 'farms'])->name('structure-farms');
  Route::get('/structure/farms/create', [FarmController::class, 'farmCreate'])->name('structure-farm-create');
  Route::get('/structure/farms/update/{id}', [FarmController::class, 'farmUpdate'])->name('structure-farm-update');
  //       → Sector
  Route::get('/structure/sectors', [SectorController::class, 'sectors'])->name('structure-sectors');
  Route::get('/structure/sectors/create', [SectorController::class, 'sectorCreate'])->name('structure-sector-create');
  Route::get('/structure/sectors/update/{id}', [SectorController::class, 'sectorUpdate'])->name('structure-sector-update');
  //       → Field
  Route::get('/structure/fields', [FieldController::class, 'fields'])->name('structure-fields');
  Route::get('/structure/fields/create', [FieldController::class, 'fieldCreate'])->name('structure-field-create');
  Route::get('/structure/fields/update/{id}', [FieldController::class, 'fieldUpdate'])->name('structure-field-update');
  //       → Section
  Route::get('/structure/sections', [SectionController::class, 'sections'])->name('structure-sections');
  Route::get('/structure/sections/create', [SectionController::class, 'sectionCreate'])->name('structure-section-create');
  Route::get('/structure/sections/update/{id}', [SectionController::class, 'sectionUpdate'])->name('structure-section-update');
  //       → Locality
  Route::get('/structure/localities', [LocalityController::class, 'localities'])->name('structure-localities');
  Route::get('/structure/localities/create', [LocalityController::class, 'localityCreate'])->name('structure-locality-create');
  Route::get('/structure/localities/update/{id}', [LocalityController::class, 'localityUpdate'])->name('structure-locality-update');
  // Cultive
  //       → Group
  Route::get('/cultive/groups', [GroupController::class, 'groups'])->name('cultive-groups');
  Route::get('/cultive/groups/create', [GroupController::class, 'groupCreate'])->name('cultive-group-create');
  Route::get('/cultive/groups/update/{id}', [GroupController::class, 'groupUpdate'])->name('cultive-group-update');
  //       → Variety
  Route::get('/cultive/varieties', [VarietyController::class, 'varieties'])->name('cultive-varieties');
  Route::get('/cultive/varieties/create', [VarietyController::class, 'varietyCreate'])->name('cultive-variety-create');
  Route::get('/cultive/varieties/update/{id}', [VarietyController::class, 'varietyUpdate'])->name('cultive-variety-update');
  //       → Process
  Route::get('/cultive/processes', [ProcessController::class, 'processes'])->name('cultive-processes');
  Route::get('/cultive/processes/create', [ProcessController::class, 'processCreate'])->name('cultive-process-create');
  Route::get('/cultive/processes/update/{id}', [ProcessController::class, 'processUpdate'])->name('cultive-process-update');
  //       → Culture
  Route::get('/cultive/cultures', [CultureController::class, 'cultures'])->name('cultive-cultures');
  Route::get('/cultive/cultures/create', [CultureController::class, 'cultureCreate'])->name('cultive-culture-create');
  Route::get('/cultive/cultures/update/{id}', [CultureController::class, 'cultureUpdate'])->name('cultive-culture-update');
  //       → Method
  Route::get('/cultive/methods', [PlantingMethodController::class, 'plantingMethods'])->name('cultive-methods');
  Route::get('/cultive/methods/create', [PlantingMethodController::class, 'plantingMethodCreate'])->name('cultive-method-create');
  Route::get('/cultive/methods/update/{id}', [PlantingMethodController::class, 'plantingMethodUpdate'])->name('cultive-method-update');
  //       → Machine Hour
  Route::get('/cultive/machine-hours', [MachineHourController::class, 'machineHours'])->name('cultive-machine-hours');
  Route::get('/cultive/machine-hours/create', [MachineHourController::class, 'machineHourCreate'])->name('cultive-machine-hour-create');
  Route::get('/cultive/machine-hours/update/{id}', [MachineHourController::class, 'machineHourUpdate'])->name('cultive-machine-hour-update');

  // Harvest
  //       → Harvest
  Route::get('/harvest/harvests', [HarvestController::class, 'harvests'])->name('harv-harvests');
  Route::get('/harvest/harvests/create', [HarvestController::class, 'harvestCreate'])->name('harv-harvest-create');
  Route::get('/harvest/harvests/update/{id}', [HarvestController::class, 'harvestUpdate'])->name('harv-harvest-update');
  //       → Harvest Configurations
  Route::get('/harvest/harvest-configurations', [HarvestConfigurationController::class, 'harvestConfigurations'])->name('harv-configurations');
  Route::get('/harvest/harvest-configurations/create', [HarvestConfigurationController::class, 'harvestConfigurationCreate'])->name('harv-configuration-create');
  Route::get('/harvest/harvest-configurations/update/{id}', [HarvestConfigurationController::class, 'harvestConfigurationUpdate'])->name('harv-configuration-update');

  // TESTANDO
  //       → Boarding
  Route::get('/boarding/boardings', [BoardingController::class, 'boardings'])->name('boar-boardings');
  Route::get('/boarding/boarding/update/{id}', [BoardingController::class, 'boardingUpdate'])->name('boar-boarding-update');
  Route::get('/boarding/boarding/read/{id}', [BoardingController::class, 'boardingRead'])->name('boar-boarding-read');
  Route::get('/boarding/boarding/detail/{id}', [BoardingController::class, 'boardingDetail'])->name('boar-boarding-detail');
  Route::get('/boarding/boarding/import', [BoardingController::class, 'boardingImport'])->name('boar-boarding-import');
  Route::get('/boarding/boarding/export', [BoardingController::class, 'boardingExport'])->name('boar-boarding-export');

  // Support
  //       → Tasks
  Route::get('/support/tasks', [TaskController::class, 'tasks'])->name('sup-tasks');
  Route::get('/support/tasks/create', [TaskController::class, 'taskCreate'])->name('sup-task-create');
  Route::post('/support/tasks/create', [TaskController::class, 'taskCreateAction']);
  Route::get('/support/tasks/update/{id}', [TaskController::class, 'taskUpdate'])->name('sup-task-update');
  Route::post('/support/tasks/update/{id}', [TaskController::class, 'taskUpdateAction']);
  Route::post('/support/tasks/delete/{id}', [TaskController::class, 'taskDelete'])->name('sup-task-delete');
  //       → Comments
  Route::post('/support/task-comments', [TaskController::class, 'commentAction'])->name('sup-task-comment');
  Route::post('/support/task-comments/update', [TaskController::class, 'commentUpdate'])->name('sup-task-comment-update');
  Route::post('/support/task-comments/delete/{id}', [TaskController::class, 'commentDelete'])->name('sup-task-comment-delete');
  //       → Roadmap
  Route::get('/support/task-roadmap', [RoadmapController::class, 'roadmap'])->name('sup-roadmap');
  Route::post('/support/task-roadmap', [RoadmapController::class, 'roadmapAction']);
  Route::post('/support/task-roadmap/update', [RoadmapController::class, 'roadmapUpdate'])->name('sup-roadmap-update');
  Route::post('/support/task-roadmap/delete/{id}', [RoadmapController::class, 'roadmapDelete'])->name('sup-roadmap-delete');
});
