<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;

class ProfillePermissionController extends Controller {
  public function ProfilePermissions() {
    return view('content.pages.sys.security.profile-permission.list');
  }

  public function ProfilePermissionCreate() {
    return view('content.pages.sys.security.profile-permission.create');
  }

  public function ProfilePermissionUpdate(int $id) {
    return view('content.pages.sys.security.profile-permission.update', compact('id'));
  }
}
