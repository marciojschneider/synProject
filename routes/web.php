<?php

use App\Http\Controllers\pages\StructureSectionController;
use App\Http\Controllers\pages\StructureSectorController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// Controllers
use App\Http\Controllers\pages\HomePage;
//       → System
use App\Http\Controllers\pages\SysClientController;
use App\Http\Controllers\pages\SysProfileController;
use App\Http\Controllers\pages\SysUserController;
use App\Http\Controllers\pages\SysClosureModuleController;
//                → Security
use App\Http\Controllers\pages\SysUserProfileController;
use App\Http\Controllers\pages\SysProfillePermissionController;
//       → Support
use App\Http\Controllers\pages\SupTaskController;
//       → Structure
use App\Http\Controllers\pages\StructureFarmController;
use App\Http\Controllers\pages\StructureOrganizationController;
use App\Http\Controllers\pages\StructureLocalityController;
use App\Http\Controllers\pages\StructureFieldController;
//       → Cultive
use App\Http\Controllers\pages\CultiveCultureController;
use App\Http\Controllers\pages\CultivePlantingMethodController;
use App\Http\Controllers\pages\CultiveProcessController;
//       → Harvest
use App\Http\Controllers\pages\HarvConfigController;
use App\Http\Controllers\pages\HarvHarvestController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction']);

Route::middleware(['auth'])->group(function () {
  // Authentication
  Route::get('/select-client', [AuthController::class, 'selectClient'])->name('select-client');
  Route::post('/select-client', [AuthController::class, 'selectClientAction']);
  Route::get('/select-profile', [AuthController::class, 'selectProfile'])->name('select-profile');
  Route::post('/select-profile', [AuthController::class, 'selectProfileAction']);
});

Route::middleware(['auth', 'canAccess'])->group(function () {
  // Homepage
  Route::get('/', [HomePage::class, 'index'])->name('homepage');

  // System
  //       → Users
  Route::get('/sys/users', [SysUserController::class, 'users'])->name('sys-users');
  Route::get('/sys/users/create', [SysUserController::class, 'userCreate'])->name('sys-user-create');
  Route::post('/sys/users/create', [SysUserController::class, 'userCreateAction']);
  Route::get('/sys/users/update/{id}', [SysUserController::class, 'userUpdate'])->name('sys-user-update');
  Route::post('/sys/users/update/{id}', [SysUserController::class, 'userUpdateAction']);
  Route::post('/sys/users/delete/{id}', [SysUserController::class, 'userDelete'])->name('sys-user-delete');
  //       → Clients
  Route::get('/sys/clients', [SysClientController::class, 'clients'])->name('sys-clients');
  Route::get('/sys/client/create', [SysClientController::class, 'clientCreate'])->name('sys-client-create');
  Route::post('/sys/client/create', [SysClientController::class, 'clientCreateAction']);
  Route::get('/sys/client/update/{id}', [SysClientController::class, 'clientUpdate'])->name('sys-client-update');
  Route::post('/sys/client/update/{id}', [SysClientController::class, 'clientUpdateAction']);
  Route::post('/sys/client/delete/{id}', [SysClientController::class, 'clientDelete'])->name('sys-client-delete');
  //       → Profiles
  Route::get('/sys/profiles', [SysProfileController::class, 'profiles'])->name('sys-profiles');
  Route::get('/sys/profile/create', [SysProfileController::class, 'profileCreate'])->name('sys-profile-create');
  Route::post('/sys/profile/create', [SysProfileController::class, 'profileCreateAction']);
  Route::get('/sys/profile/update/{id}', [SysProfileController::class, 'profileUpdate'])->name('sys-profile-update');
  Route::post('/sys/profile/update/{id}', [SysProfileController::class, 'profileUpdateAction']);
  Route::post('/sys/profile/delete/{id}', [SysProfileController::class, 'profileDelete'])->name('sys-profile-delete');
  //       → Closure Modules
  Route::get('/sys/closure-modules', [SysClosureModuleController::class, 'closureModules'])->name('sys-closures');
  Route::get('/sys/closure-module/create', [SysClosureModuleController::class, 'closureModuleCreate'])->name('sys-closure-create');
  Route::post('/sys/closure-module/create', [SysClosureModuleController::class, 'closureModuleCreateAction']);
  Route::get('/sys/closure-module/update/{id}', [SysClosureModuleController::class, 'closureModuleUpdate'])->name('sys-closure-update');
  Route::post('/sys/closure-module/update/{id}', [SysClosureModuleController::class, 'closureModuleUpdateAction']);
  Route::post('/sys/closure-module/delete/{id}', [SysClosureModuleController::class, 'closureModuleDelete'])->name('sys-closure-delete');
  //       → Security
  //                  → Permissions
  Route::get('/sys/profile/permissions', [SysProfillePermissionController::class, 'profilePermissions'])->name('sys-sec-permissions');
  Route::get('/sys/profile/permission/create', [SysProfillePermissionController::class, 'profilePermissionsCreate'])->name('sys-sec-permission-create');
  Route::post('/sys/profile/permission/create', [SysProfillePermissionController::class, 'profilePermissionsCreateAction']);
  Route::get('/sys/profile/permission/update/{id}', [SysProfillePermissionController::class, 'profilePermissionsUpdate'])->name('sys-sec-permission-update');
  Route::post('/sys/profile/permission/update/{id}', [SysProfillePermissionController::class, 'profilePermissionsUpdateAction']);
  Route::post('/sys/profile/permission/delete/{id}', [SysProfillePermissionController::class, 'profilePermissionsDelete'])->name('sys-sec-permission-delete');
  //                  → User Profiles TODO: (Verificar nomenclatura de rotas)
  Route::get('/sys/user/profile', [SysUserProfileController::class, 'userProfiles'])->name('sys-sec-u-ps');
  Route::get('/sys/user/profile/create', [SysUserProfileController::class, 'userProfileCreate'])->name('sys-sec-u-p-create');
  Route::post('/sys/user/profile/create', [SysUserProfileController::class, 'userProfileCreateAction']);
  Route::get('/sys/user/profile/update/{id}', [SysUserProfileController::class, 'userProfileUpdate'])->name('sys-sec-u-p-update');
  Route::post('/sys/user/profile/update/{id}', [SysUserProfileController::class, 'userProfileUpdateAction']);
  Route::post('/sys/user/profile/delete/{id}', [SysUserProfileController::class, 'userProfileDelete'])->name('sys-sec-u-p-delete');

  // Support
  //       → Tasks
  Route::get('/sup/tasks', [SupTaskController::class, 'tasks'])->name('sup-tasks');
  Route::get('/sup/task/create', [SupTaskController::class, 'taskCreate'])->name('sup-task-create');
  Route::post('/sup/task/create', [SupTaskController::class, 'taskCreateAction']);
  Route::get('/sup/task/update/{id}', [SupTaskController::class, 'taskUpdate'])->name('sup-task-update');
  Route::post('/sup/task/update/{id}', [SupTaskController::class, 'taskUpdateAction']);
  Route::post('/sup/task/delete/{id}', [SupTaskController::class, 'taskDelete'])->name('sup-task-delete');
  //       → Comments
  Route::post('/sup/task/comment', [SupTaskController::class, 'commentAction'])->name('sup-comment');
  Route::post('/sup/task/comment/update', [SupTaskController::class, 'commentUpdate'])->name('sup-comment-update');
  Route::post('/sup/task/comment/delete/{id}', [SupTaskController::class, 'commentDelete'])->name('sup-comment-delete');
  //       → Roadmap
  Route::get('/sup/task/roadmap', [SupTaskController::class, 'roadmap'])->name('sup-roadmap');
  Route::post('/sup/task/roadmap', [SupTaskController::class, 'roadmapAction']);
  Route::post('/sup/task/roadmap/update', [SupTaskController::class, 'roadmapUpdate'])->name('sup-roadmap-update');
  Route::post('/sup/task/roadmap/delete/{id}', [SupTaskController::class, 'roadmapDelete'])->name('sup-roadmap-delete');

  // Structure
  //       → Organization
  Route::get('/structure/organizations', [StructureOrganizationController::class, 'organizations'])->name('structure-organizations');
  Route::get('/structure/organization/create', [StructureOrganizationController::class, 'organizationCreate'])->name('structure-organization-create');
  Route::post('/structure/organization/create', [StructureOrganizationController::class, 'organizationCreateAction']);
  Route::get('/structure/organization/update/{id}', [StructureOrganizationController::class, 'organizationUpdate'])->name('structure-organization-update');
  Route::post('/structure/organization/update/{id}', [StructureOrganizationController::class, 'organizationUpdateAction']);
  Route::post('/structure/organization/delete/{id}', [StructureOrganizationController::class, 'organizationDelete'])->name('structure-organization-delete');
  //       → Farm
  Route::get('/structure/farms', [StructureFarmController::class, 'farms'])->name('structure-farms');
  Route::get('/structure/farm/create', [StructureFarmController::class, 'farmCreate'])->name('structure-farm-create');
  Route::post('/structure/farm/create', [StructureFarmController::class, 'farmCreateAction']);
  Route::get('/structure/farm/update/{id}', [StructureFarmController::class, 'farmUpdate'])->name('structure-farm-update');
  Route::post('/structure/farm/update/{id}', [StructureFarmController::class, 'farmUpdateAction']);
  Route::post('/structure/farm/delete/{id}', [StructureFarmController::class, 'farmDelete'])->name('structure-farm-delete');
  //       → Locality
  Route::get('/structure/localities', [StructureLocalityController::class, 'localities'])->name('structure-localities');
  Route::get('/structure/locality/create', [StructureLocalityController::class, 'localityCreate'])->name('structure-locality-create');
  Route::post('/structure/locality/create', [StructureLocalityController::class, 'localityCreateAction']);
  Route::get('/structure/locality/update/{id}', [StructureLocalityController::class, 'localityUpdate'])->name('structure-locality-update');
  Route::post('/structure/locality/update/{id}', [StructureLocalityController::class, 'localityUpdateAction']);
  Route::post('/structure/locality/delete/{id}', [StructureLocalityController::class, 'localityDelete'])->name('structure-locality-delete');
  //       → Field
  Route::get('/structure/fields', [StructureFieldController::class, 'fields'])->name('structure-fields');
  Route::get('/structure/field/create', [StructureFieldController::class, 'fieldCreate'])->name('structure-field-create');
  Route::post('/structure/field/create', [StructureFieldController::class, 'fieldCreateAction']);
  Route::get('/structure/field/update/{id}', [StructureFieldController::class, 'fieldUpdate'])->name('structure-field-update');
  Route::post('/structure/field/update/{id}', [StructureFieldController::class, 'fieldUpdateAction']);
  Route::post('/structure/field/delete/{id}', [StructureFieldController::class, 'fieldDelete'])->name('structure-field-delete');
  //       → Sector
  Route::get('/structure/sectors', [StructureSectorController::class, 'sectors'])->name('structure-sectors');
  Route::get('/structure/sector/create', [StructureSectorController::class, 'sectorCreate'])->name('structure-sector-create');
  Route::post('/structure/sector/create', [StructureSectorController::class, 'sectorCreateAction']);
  Route::get('/structure/sector/update/{id}', [StructureSectorController::class, 'sectorUpdate'])->name('structure-sector-update');
  Route::post('/structure/sector/update/{id}', [StructureSectorController::class, 'sectorUpdateAction']);
  Route::post('/structure/sector/delete/{id}', [StructureSectorController::class, 'sectorDelete'])->name('structure-sector-delete');
  //       → Section
  Route::get('/structure/sections', [StructureSectionController::class, 'sections'])->name('structure-sections');
  Route::get('/structure/section/create', [StructureSectionController::class, 'sectionCreate'])->name('structure-section-create');
  Route::post('/structure/section/create', [StructureSectionController::class, 'sectionCreateAction']);
  Route::get('/structure/section/update/{id}', [StructureSectionController::class, 'sectionUpdate'])->name('structure-section-update');
  Route::post('/structure/section/update/{id}', [StructureSectionController::class, 'sectionUpdateAction']);
  Route::post('/structure/section/delete/{id}', [StructureSectionController::class, 'sectionDelete'])->name('structure-section-delete');

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
  //       → Machine Hour

  //Harvest
  //       → Harvest
  Route::get('/harv/harvests', [HarvHarvestController::class, 'harvests'])->name('harv-harvests');
  Route::get('/harv/harvest/create', [HarvHarvestController::class, 'harvestCreate'])->name('harv-harvest-create');
  Route::post('/harv/harvest/create', [HarvHarvestController::class, 'harvestCreateAction']);
  Route::get('/harv/harvest/update/{id}', [HarvHarvestController::class, 'harvestUpdate'])->name('harv-harvest-update');
  Route::post('/harv/harvest/update/{id}', [HarvHarvestController::class, 'harvestUpdateAction']);
  Route::post('/harv/harvest/delete/{id}', [HarvHarvestController::class, 'harvestDelete'])->name('harv-harvest-delete');
  //       → Harvest Configurations
  Route::get('/harv/configuration', [HarvConfigController::class, 'configurations'])->name('harv-configurations');
  Route::get('/harv/configuration/create', [HarvConfigController::class, 'configurationCreate'])->name('harv-configuration-create');
  Route::post('/harv/configuration/create', [HarvConfigController::class, 'configurationCreateAction']);
  Route::get('/harv/configuration/update/{id}', [HarvConfigController::class, 'configurationUpdate'])->name('harv-configuration-update');
  Route::post('/harv/configuration/update/{id}', [HarvConfigController::class, 'configurationUpdateAction']);
  Route::post('/harv/configuration/delete/{id}', [HarvConfigController::class, 'configurationDelete'])->name('harv-configuration-delete');
});
