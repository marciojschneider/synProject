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
    $user = auth()->user();
    $data = $request->only(['sidebar', 'profile', 'description', 'listCheck', 'createCheck', 'updateCheck', 'deleteCheck']);

    $profilePermissionCreate = new profilePermission();
    $profilePermissionCreate->profile_id = $data['profile'];
    $profilePermissionCreate->sidebar_id = $data['sidebar'];
    $profilePermissionCreate->list = isset($data['listCheck']) ? 1 : 0;
    $profilePermissionCreate->create = isset($data['createCheck']) ? 1 : 0;
    $profilePermissionCreate->update = isset($data['updateCheck']) ? 1 : 0;
    $profilePermissionCreate->delete = isset($data['deleteCheck']) ? 1 : 0;
    $profilePermissionCreate->description = strtoupper($data['description']);
    $profilePermissionCreate->client_id = $user->in_client;
    $profilePermissionCreate->creation_user = $user->id;
    $profilePermissionCreate->save();

    return redirect()->route('sys-sec-permissions');
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
    $profilePermissionUpdate->description = strtoupper($update['description']);
    $profilePermissionUpdate->save();

    return redirect()->route('sys-sec-permissions');
  }

  public function profilePermissionsDelete(int $id) {
    profilePermission::where('id', $id)->delete();

    return redirect()->route('sys-sec-permissions');
  }
}
