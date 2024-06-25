<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;
use App\Models\profilePermission;
use Illuminate\Http\Request;

class ProfillePermissionController extends Controller {
  public function profilePermissions() {
    return view('content.pages.sys.security.profile-permission.list');
  }

  public function profilePermissionCreate() {
    return view('content.pages.sys.security.profile-permission.create');
  }

  public function profilePermissionCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['module', 'screen', 'profile', 'description', 'viewCheck', 'createCheck', 'updateCheck', 'deleteCheck']);

    $verifyUniqueModule = profilePermission::where('sidebar_id', $data['module'])->where('profile_id', $data['profile'])->first();
    if (!$verifyUniqueModule) {
      $moduleCreate = new profilePermission();
      $moduleCreate->profile_id = $data['profile'];
      $moduleCreate->sidebar_id = $data['module'];
      $moduleCreate->view = 1;
      $moduleCreate->creation_user = $user->id;
      $moduleCreate->client_id = $user->in_client;
      $moduleCreate->save();
    }

    $verifyUniqueScreen = profilePermission::where('sidebar_id', $data['screen'])->where('profile_id', $data['profile'])->first();
    if ($verifyUniqueScreen) {
      return redirect()->route('sys-sec-permissions');
    }

    $profilePermissionCreate = new profilePermission();
    $profilePermissionCreate->profile_id = $data['profile'];
    $profilePermissionCreate->sidebar_id = $data['screen'];
    $profilePermissionCreate->view = isset($data['viewCheck']) ? 1 : 0;
    $profilePermissionCreate->create = isset($data['createCheck']) ? 1 : 0;
    $profilePermissionCreate->update = isset($data['updateCheck']) ? 1 : 0;
    $profilePermissionCreate->delete = isset($data['deleteCheck']) ? 1 : 0;
    $profilePermissionCreate->description = strtoupper($data['description']);
    $profilePermissionCreate->client_id = $user->in_client;
    $profilePermissionCreate->creation_user = $user->id;
    $profilePermissionCreate->save();

    return redirect()->route('sys-sec-permissions');
  }

  public function profilePermissionUpdate(int $id) {
    return view('content.pages.sys.security.profile-permission.update', compact('id'));
  }

  public function profilePermissionUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['module', 'screen', 'profile', 'description', 'viewCheck', 'createCheck', 'updateCheck', 'deleteCheck']);

    $verifyUniqueScreen = profilePermission::where('sidebar_id', $update['screen'])->where('profile_id', $update['profile'])->get();
    if ($verifyUniqueScreen) {
      return redirect()->route('sys-sec-permissions');
    }

    $profilePermissionUpdate = profilePermission::where('id', $id)->where('client_id', $user->in_client)->first();
    if ($profilePermissionUpdate) {
      return redirect()->route('sys-sec-permissions');
    }

    $profilePermissionUpdate->profile_id = $update['profile'];
    $profilePermissionUpdate->view = isset($update['viewCheck']) ? 1 : 0;
    $profilePermissionUpdate->create = isset($update['createCheck']) ? 1 : 0;
    $profilePermissionUpdate->update = isset($update['updateCheck']) ? 1 : 0;
    $profilePermissionUpdate->delete = isset($update['deleteCheck']) ? 1 : 0;
    $profilePermissionUpdate->description = strtoupper($update['description']);
    $profilePermissionUpdate->save();

    return redirect()->route('sys-sec-permissions');
  }

  public function profilePermissionDelete(int $id) {
    $user = auth()->user();
    profilePermission::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-permissions');
  }
}
