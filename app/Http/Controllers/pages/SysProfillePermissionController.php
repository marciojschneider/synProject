<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Profile;
use App\Models\profilePermission;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class SysProfillePermissionController extends Controller {
  public function profilePermissions() {
    return view('content.pages.sys.security.profile-permission.list');
  }

  public function profilePermissionsCreate() {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['profiles'] = Profile::all();
    // $data['profiles'] = Profile::where('client_id', 1)->get();

    return view('content.pages.sys.security.profile-permission.create', $data);
  }

  public function profilePermissionsCreateAction(Request $request) {
    $data = $request->only(['sidebar', 'profile', 'description', 'listCheck', 'createCheck', 'updateCheck', 'deleteCheck']);

    $profilePermission = new profilePermission();

    $profilePermission->profile_id = $data['profile'];
    $profilePermission->sidebar_id = $data['sidebar'];
    $profilePermission->list = isset($data['listCheck']) ? 1 : 0;
    $profilePermission->create = isset($data['createCheck']) ? 1 : 0;
    $profilePermission->update = isset($data['updateCheck']) ? 1 : 0;
    $profilePermission->delete = isset($data['deleteCheck']) ? 1 : 0;
    $profilePermission->description = $data['description'];
    $profilePermission->save();

    return redirect()->route('sys-permissions');
  }

  public function profilePermissionsUpdate(int $id) {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['profiles'] = Profile::all();

    $data['profilePermission'] = profilePermission::find($id);

    return view('content.pages.sys.security.profile-permission.update', $data);
  }

  public function profilePermissionsUpdateAction(int $id, Request $request) {
    $update = $request->only(['sidebar', 'profile', 'description', 'listCheck', 'createCheck', 'updateCheck', 'deleteCheck']);
    $profilePermissionUpdate = profilePermission::find($id);

    $profilePermissionUpdate->profile_id = $update['profile'];
    $profilePermissionUpdate->list = isset($update['listCheck']) ? 1 : 0;
    $profilePermissionUpdate->create = isset($update['createCheck']) ? 1 : 0;
    $profilePermissionUpdate->update = isset($update['updateCheck']) ? 1 : 0;
    $profilePermissionUpdate->delete = isset($update['deleteCheck']) ? 1 : 0;
    $profilePermissionUpdate->description = $update['description'];

    $profilePermissionUpdate->save();

    return redirect()->route('sys-permissions');
  }

  public function profilePermissionsDelete(int $id) {
    profilePermission::where('id', $id)->delete();

    return redirect()->route('sys-permissions');
  }
}
