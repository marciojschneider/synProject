<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;
// Models
use App\Models\profilePermission;

class ProfillePermissionController extends Controller {
  public function profilePermissions() {
    return view('content.pages.sys.security.profile-permission.list');
  }

  public function profilePermissionCreate() {
    return view('content.pages.sys.security.profile-permission.create');
  }

  public function profilePermissionUpdate(int $id) {
    return view('content.pages.sys.security.profile-permission.update', compact('id'));
  }

  public function profilePermissionDelete(int $id) {
    $user = auth()->user();
    profilePermission::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-permissions');
  }
}
