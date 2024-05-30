<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Profile;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class ModuleController extends Controller {
  public function modules() {
    return view('content.pages.module.list');
  }

  public function moduleCreate() {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['profiles'] = Profile::where('client_id', 1)->get();

    return view('content.pages.module.create', $data);
  }

  public function moduleCreateAction(Request $request) {
    $data = $request->only(['sidebar', 'profile', 'description', 'listCheck', 'createCheck', 'updateCheck', 'deleteCheck']);

    $sidebar = Sidebar::find($data['sidebar']);
    $data['name'] = $sidebar->name;
    $data['slug'] = $sidebar->slug;

    $module = new Module();
    $modulePermission = new ModulePermission();

    $module->name = $data['name'];
    $module->slug = $data['slug'];
    $module->description = $data['description'];
    $module->save();

    $modulePermission->module_id = $module->id;
    $modulePermission->profile_id = $data['profile'];
    $modulePermission->list = isset($data['listCheck']) ? 1 : 0;
    $modulePermission->create = isset($data['createCheck']) ? 1 : 0;
    $modulePermission->update = isset($data['updateCheck']) ? 1 : 0;
    $modulePermission->delete = isset($data['deleteCheck']) ? 1 : 0;
    $modulePermission->save();

    return redirect()->route('sys-modules');
  }

  public function moduleUpdate(int $id) {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['profiles'] = Profile::where('client_id', 1)->get();

    $data['module'] = Module::find($id);
    $permissions = ModulePermission::where('module_id', $data['module']->id)->get();
    $data['permissions'] = $permissions[0];

    return view('content.pages.module.update', $data);
  }

  public function moduleUpdateAction(int $id, Request $request) {
    $update = $request->only(['sidebar', 'profile', 'description', 'listCheck', 'createCheck', 'updateCheck', 'deleteCheck']);
    $moduleUpdate = Module::find($id);
    $getPermission = ModulePermission::where('module_id', $moduleUpdate->id)->get();
    $modulePermissionUpdate = ModulePermission::find($getPermission[0]->id);

    $moduleUpdate->description = $update['description'];
    $moduleUpdate->save();

    $modulePermissionUpdate->profile_id = $update['profile'];
    $modulePermissionUpdate->list = isset($update['listCheck']) ? 1 : 0;
    $modulePermissionUpdate->create = isset($update['createCheck']) ? 1 : 0;
    $modulePermissionUpdate->update = isset($update['updateCheck']) ? 1 : 0;
    $modulePermissionUpdate->delete = isset($update['deleteCheck']) ? 1 : 0;
    $modulePermissionUpdate->save();

    return redirect()->route('sys-modules');
  }
}
