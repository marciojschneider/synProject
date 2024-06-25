<?php

use App\Http\Controllers\pages\HarvHarvestConfigurationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// Controllers
use App\Http\Controllers\pages\HomePage;
//       → System
use App\Http\Controllers\pages\Sys\ClientController;
use App\Http\Controllers\pages\Sys\ProfileController;
use App\Http\Controllers\pages\Sys\UserController;
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
use App\Http\Controllers\pages\CultiveCultureController;
use App\Http\Controllers\pages\CultivePlantingMethodController;
use App\Http\Controllers\pages\CultiveProcessController;
use App\Http\Controllers\pages\CultiveGroupController;
use App\Http\Controllers\pages\CultiveVarietyController;
//       → Harvest
use App\Http\Controllers\pages\Harvest\HarvestController;
use App\Http\Controllers\pages\Harvest\HarvestConfigurationController;

//       → Support
use App\Http\Controllers\pages\SupTaskController;

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

  route::post('/logout', function () {
    return redirect()->route('login');
  })->name('logout');
});

Route::middleware(['auth', 'canAccess'])->group(function () {
  // Homepage
  Route::get('/', [HomePage::class, 'index'])->name('homepage');

  // System
  //       → Users
  Route::get('/sys/users', [UserController::class, 'users'])->name('sys-users');
  Route::get('/sys/users/create', [UserController::class, 'userCreate'])->name('sys-user-create');
  Route::post('/sys/users/create', [UserController::class, 'userCreateAction']);
  Route::get('/sys/users/update/{id}', [UserController::class, 'userUpdate'])->name('sys-user-update');
  Route::post('/sys/users/update/{id}', [UserController::class, 'userUpdateAction']);
  Route::post('/sys/users/delete/{id}', [UserController::class, 'userDelete'])->name('sys-user-delete');
  //       → Clients
  Route::get('/sys/clients', [ClientController::class, 'clients'])->name('sys-clients');
  Route::get('/sys/clients/create', [ClientController::class, 'clientCreate'])->name('sys-client-create');
  Route::post('/sys/clients/create', [ClientController::class, 'clientCreateAction']);
  Route::get('/sys/clients/update/{id}', [ClientController::class, 'clientUpdate'])->name('sys-client-update');
  Route::post('/sys/clients/update/{id}', [ClientController::class, 'clientUpdateAction']);
  Route::post('/sys/clients/delete/{id}', [ClientController::class, 'clientDelete'])->name('sys-client-delete');
  //       → Profiles
  Route::get('/sys/profiles', [ProfileController::class, 'profiles'])->name('sys-profiles');
  Route::get('/sys/profiles/create', [ProfileController::class, 'profileCreate'])->name('sys-profile-create');
  Route::post('/sys/profiles/create', [ProfileController::class, 'profileCreateAction']);
  Route::get('/sys/profiles/update/{id}', [ProfileController::class, 'profileUpdate'])->name('sys-profile-update');
  Route::post('/sys/profiles/update/{id}', [ProfileController::class, 'profileUpdateAction']);
  Route::post('/sys/profiles/delete/{id}', [ProfileController::class, 'profileDelete'])->name('sys-profile-delete');
  //       → Security
  //                  → Closure Modules
  Route::get('/sys/closure-modules', [ClosureModuleController::class, 'closureModules'])->name('sys-sec-closures');
  Route::get('/sys/closure-modules/create', [ClosureModuleController::class, 'closureModuleCreate'])->name('sys-sec-closure-create');
  Route::post('/sys/closure-modules/create', [ClosureModuleController::class, 'closureModuleCreateAction']);
  Route::get('/sys/closure-modules/update/{id}', [ClosureModuleController::class, 'closureModuleUpdate'])->name('sys-sec-closure-update');
  Route::post('/sys/closure-modules/update/{id}', [ClosureModuleController::class, 'closureModuleUpdateAction']);
  Route::post('/sys/closure-modules/delete/{id}', [ClosureModuleController::class, 'closureModuleDelete'])->name('sys-sec-closure-delete');
  //                  → Permissions
  Route::get('/sys/p-permissions', [ProfillePermissionController::class, 'profilePermissions'])->name('sys-sec-permissions');
  Route::get('/sys/p-permissions/create', [ProfillePermissionController::class, 'profilePermissionCreate'])->name('sys-sec-permission-create');
  Route::post('/sys/p-permissions/create', [ProfillePermissionController::class, 'profilePermissionCreateAction']);
  Route::get('/sys/p-permissions/update/{id}', [ProfillePermissionController::class, 'profilePermissionUpdate'])->name('sys-sec-permission-update');
  Route::post('/sys/p-permissions/update/{id}', [ProfillePermissionController::class, 'profilePermissionUpdateAction']);
  Route::post('/sys/p-permissions/delete/{id}', [ProfillePermissionController::class, 'profilePermissionDelete'])->name('sys-sec-permission-delete');
  //                  → User Profiles
  Route::get('/sys/u-profiles', [UserProfileController::class, 'userProfiles'])->name('sys-sec-u-ps');
  Route::get('/sys/u-profiles/create', [UserProfileController::class, 'userProfileCreate'])->name('sys-sec-u-p-create');
  Route::post('/sys/u-profiles/create', [UserProfileController::class, 'userProfileCreateAction']);
  Route::get('/sys/u-profiles/update/{id}', [UserProfileController::class, 'userProfileUpdate'])->name('sys-sec-u-p-update');
  Route::post('/sys/u-profiles/update/{id}', [UserProfileController::class, 'userProfileUpdateAction']);
  Route::post('/sys/u-profiles/delete/{id}', [UserProfileController::class, 'userProfileDelete'])->name('sys-sec-u-p-delete');

  // Structure
  //       → Organization
  Route::get('/structure/organizations', [OrganizationController::class, 'organizations'])->name('structure-organizations');
  Route::get('/structure/organizations/create', [OrganizationController::class, 'organizationCreate'])->name('structure-organization-create');
  Route::post('/structure/organizations/create', [OrganizationController::class, 'organizationCreateAction']);
  Route::get('/structure/organizations/update/{id}', [OrganizationController::class, 'organizationUpdate'])->name('structure-organization-update');
  Route::post('/structure/organizations/update/{id}', [OrganizationController::class, 'organizationUpdateAction']);
  Route::post('/structure/organizations/delete/{id}', [OrganizationController::class, 'organizationDelete'])->name('structure-organization-delete');
  //       → Farm
  Route::get('/structure/farms', [FarmController::class, 'farms'])->name('structure-farms');
  Route::get('/structure/farms/create', [FarmController::class, 'farmCreate'])->name('structure-farm-create');
  Route::post('/structure/farms/create', [FarmController::class, 'farmCreateAction']);
  Route::get('/structure/farms/update/{id}', [FarmController::class, 'farmUpdate'])->name('structure-farm-update');
  Route::post('/structure/farms/update/{id}', [FarmController::class, 'farmUpdateAction']);
  Route::post('/structure/farms/delete/{id}', [FarmController::class, 'farmDelete'])->name('structure-farm-delete');
  //       → Locality
  Route::get('/structure/localities', [LocalityController::class, 'localities'])->name('structure-localities');
  Route::get('/structure/localities/create', [LocalityController::class, 'localityCreate'])->name('structure-locality-create');
  Route::post('/structure/localities/create', [LocalityController::class, 'localityCreateAction']);
  Route::get('/structure/localities/update/{id}', [LocalityController::class, 'localityUpdate'])->name('structure-locality-update');
  Route::post('/structure/localities/update/{id}', [LocalityController::class, 'localityUpdateAction']);
  Route::post('/structure/localities/delete/{id}', [LocalityController::class, 'localityDelete'])->name('structure-locality-delete');
  //       → Field
  Route::get('/structure/fields', [FieldController::class, 'fields'])->name('structure-fields');
  Route::get('/structure/fields/create', [FieldController::class, 'fieldCreate'])->name('structure-field-create');
  Route::post('/structure/fields/create', [FieldController::class, 'fieldCreateAction']);
  Route::get('/structure/fields/update/{id}', [FieldController::class, 'fieldUpdate'])->name('structure-field-update');
  Route::post('/structure/fields/update/{id}', [FieldController::class, 'fieldUpdateAction']);
  Route::post('/structure/fields/delete/{id}', [FieldController::class, 'fieldDelete'])->name('structure-field-delete');
  //       → Sector
  Route::get('/structure/sectors', [SectorController::class, 'sectors'])->name('structure-sectors');
  Route::get('/structure/sectors/create', [SectorController::class, 'sectorCreate'])->name('structure-sector-create');
  Route::post('/structure/sectors/create', [SectorController::class, 'sectorCreateAction']);
  Route::get('/structure/sectors/update/{id}', [SectorController::class, 'sectorUpdate'])->name('structure-sector-update');
  Route::post('/structure/sectors/update/{id}', [SectorController::class, 'sectorUpdateAction']);
  Route::post('/structure/sectors/delete/{id}', [SectorController::class, 'sectorDelete'])->name('structure-sector-delete');
  //       → Section
  Route::get('/structure/sections', [SectionController::class, 'sections'])->name('structure-sections');
  Route::get('/structure/sections/create', [SectionController::class, 'sectionCreate'])->name('structure-section-create');
  Route::post('/structure/sections/create', [SectionController::class, 'sectionCreateAction']);
  Route::get('/structure/sections/update/{id}', [SectionController::class, 'sectionUpdate'])->name('structure-section-update');
  Route::post('/structure/sections/update/{id}', [SectionController::class, 'sectionUpdateAction']);
  Route::post('/structure/sections/delete/{id}', [SectionController::class, 'sectionDelete'])->name('structure-section-delete');

  // Cultive
  //       → Method
  Route::get('/cultive/methods', [CultivePlantingMethodController::class, 'plantingMethods'])->name('cultive-methods');
  Route::get('/cultive/method/create', [CultivePlantingMethodController::class, 'plantingMethodCreate'])->name('cultive-method-create');
  Route::post('/cultive/method/create', [CultivePlantingMethodController::class, 'plantingMethodCreateAction']);
  Route::get('/cultive/method/update/{id}', [CultivePlantingMethodController::class, 'plantingMethodUpdate'])->name('cultive-method-update');
  Route::post('/cultive/method/update/{id}', [CultivePlantingMethodController::class, 'plantingMethodUpdateAction']);
  Route::post('/cultive/method/delete/{id}', [CultivePlantingMethodController::class, 'plantingMethodDelete'])->name('cultive-method-delete');
  //       → Process
  Route::get('/cultive/processes', [CultiveProcessController::class, 'processes'])->name('cultive-processes');
  Route::get('/cultive/process/create', [CultiveProcessController::class, 'processCreate'])->name('cultive-process-create');
  Route::post('/cultive/process/create', [CultiveProcessController::class, 'processCreateAction']);
  Route::get('/cultive/process/update/{id}', [CultiveProcessController::class, 'processUpdate'])->name('cultive-process-update');
  Route::post('/cultive/process/update/{id}', [CultiveProcessController::class, 'processUpdateAction']);
  Route::post('/cultive/process/delete/{id}', [CultiveProcessController::class, 'processDelete'])->name('cultive-process-delete');
  //       → Culture
  Route::get('/cultive/cultures', [CultiveCultureController::class, 'cultures'])->name('cultive-cultures');
  Route::get('/cultive/culture/create', [CultiveCultureController::class, 'cultureCreate'])->name('cultive-culture-create');
  Route::post('/cultive/culture/create', [CultiveCultureController::class, 'cultureCreateAction']);
  Route::get('/cultive/culture/update/{id}', [CultiveCultureController::class, 'cultureUpdate'])->name('cultive-culture-update');
  Route::post('/cultive/culture/update/{id}', [CultiveCultureController::class, 'cultureUpdateAction']);
  Route::post('/cultive/culture/delete/{id}', [CultiveCultureController::class, 'cultureDelete'])->name('cultive-culture-delete');
  //       → Group
  Route::get('/cultive/groups', [CultiveGroupController::class, 'groups'])->name('cultive-groups');
  Route::get('/cultive/group/create', [CultiveGroupController::class, 'groupCreate'])->name('cultive-group-create');
  Route::post('/cultive/group/create', [CultiveGroupController::class, 'groupCreateAction']);
  Route::get('/cultive/group/update/{id}', [CultiveGroupController::class, 'groupUpdate'])->name('cultive-group-update');
  Route::post('/cultive/group/update/{id}', [CultiveGroupController::class, 'groupUpdateAction']);
  Route::post('/cultive/group/delete/{id}', [CultiveGroupController::class, 'groupDelete'])->name('cultive-group-delete');
  //       → Variety
  Route::get('/cultive/varieties', [CultiveVarietyController::class, 'varieties'])->name('cultive-varieties');
  Route::get('/cultive/variety/create', [CultiveVarietyController::class, 'varietyCreate'])->name('cultive-variety-create');
  Route::post('/cultive/variety/create', [CultiveVarietyController::class, 'varietyCreateAction']);
  Route::get('/cultive/variety/update/{id}', [CultiveVarietyController::class, 'varietyUpdate'])->name('cultive-variety-update');
  Route::post('/cultive/variety/update/{id}', [CultiveVarietyController::class, 'varietyUpdateAction']);
  Route::post('/cultive/variety/delete/{id}', [CultiveVarietyController::class, 'varietyDelete'])->name('cultive-variety-delete');
  //       → Machine Hour

  //Harvest
  //       → Harvest
  Route::get('/harvest/harvests', [HarvestController::class, 'harvests'])->name('harv-harvests');
  Route::get('/harvest/harvests/create', [HarvestController::class, 'harvestCreate'])->name('harv-harvest-create');
  Route::post('/harvest/harvests/create', [HarvestController::class, 'harvestCreateAction']);
  Route::get('/harvest/harvests/update/{id}', [HarvestController::class, 'harvestUpdate'])->name('harv-harvest-update');
  Route::post('/harvest/harvests/update/{id}', [HarvestController::class, 'harvestUpdateAction']);
  Route::post('/harvest/harvests/delete/{id}', [HarvestController::class, 'harvestDelete'])->name('harv-harvest-delete');
  //       → Harvest Configurations
  Route::get('/harvest/harvest-configurations', [HarvestConfigurationController::class, 'harvestConfigurations'])->name('harv-configurations');
  Route::get('/harvest/harvest-configurations/create', [HarvestConfigurationController::class, 'harvestConfigurationCreate'])->name('harv-configuration-create');
  Route::post('/harvest/harvest-configurations/create', [HarvestConfigurationController::class, 'harvestConfigurationCreateAction']);
  Route::get('/harvest/harvest-configurations/update/{id}', [HarvestConfigurationController::class, 'harvestConfigurationUpdate'])->name('harv-configuration-update');
  Route::post('/harvest/harvest-configurations/update/{id}', [HarvestConfigurationController::class, 'harvestConfigurationUpdateAction']);
  Route::post('/harvest/harvest-configurations/delete/{id}', [HarvestConfigurationController::class, 'harvestConfigurationDelete'])->name('harv-configuration-delete');

  // Support
  //       → Tasks
  Route::get('/sup/tasks', [SupTaskController::class, 'tasks'])->name('sup-tasks');
  Route::get('/sup/task/create', [SupTaskController::class, 'taskCreate'])->name('sup-task-create');
  Route::post('/sup/task/create', [SupTaskController::class, 'taskCreateAction']);
  Route::get('/sup/task/update/{id}', [SupTaskController::class, 'taskUpdate'])->name('sup-task-update');
  Route::post('/sup/task/update/{id}', [SupTaskController::class, 'taskUpdateAction']);
  Route::post('/sup/task/delete/{id}', [SupTaskController::class, 'taskDelete'])->name('sup-task-delete');
  //       → Comments
  Route::post('/sup/task-comment', [SupTaskController::class, 'commentAction'])->name('sup-comment');
  Route::post('/sup/task-comment/update', [SupTaskController::class, 'commentUpdate'])->name('sup-comment-update');
  Route::post('/sup/task-comment/delete/{id}', [SupTaskController::class, 'commentDelete'])->name('sup-comment-delete');
  //       → Roadmap
  Route::get('/sup/task-roadmap', [SupTaskController::class, 'roadmap'])->name('sup-roadmap');
  Route::post('/sup/task-roadmap', [SupTaskController::class, 'roadmapAction']);
  Route::post('/sup/task-roadmap/update', [SupTaskController::class, 'roadmapUpdate'])->name('sup-roadmap-update');
  Route::post('/sup/task-roadmap/delete/{id}', [SupTaskController::class, 'roadmapDelete'])->name('sup-roadmap-delete');
});
