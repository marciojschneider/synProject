<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SysUserProfileController extends Controller {
  public function userProfiles() {
    return view('content.pages.sys.security.user-profile.list');
  }

  public function userProfileCreate() {
    return view('content.pages.sys.security.user-profile.list');
  }

  public function userProfileCreateAction(Request $request) {
    dd($request);
  }

  public function userProfileUpdate(int $id) {
    dd($id);
  }

  public function userProfileUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function userProfileDelete(int $id) {
    dd($id);
  }
}
