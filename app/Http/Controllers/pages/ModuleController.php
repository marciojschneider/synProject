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
    $modulePermission->list = $data['listCheck'] == 'on' ? 1 : 0;
    $modulePermission->create = $data['createCheck'] == 'on' ? 1 : 0;
    $modulePermission->update = $data['updateCheck'] == 'on' ? 1 : 0;
    $modulePermission->delete = $data['deleteCheck'] == 'on' ? 1 : 0;
    $modulePermission->save();

    return redirect()->route('sys-modules');
  }

  public function moduleUpdate(int $id) {
    $data['module'] = Module::find($id);
    $data['profiles'] = Profile::where('client_id', 1)->get();

    return view('content.pages.module.update', $data);
  }

  public function moduleUpdateAction(int $id, Request $request) {
    dd($request);
  }
}
