<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;

class ProfileController extends Controller {
  public function profiles() {
    return view('content.pages.sys.profile.list');
  }

  public function profileCreate() {
    return view('content.pages.sys.profile.create');
  }

  public function profileUpdate(int $id) {
    return view('content.pages.sys.profile.update', compact('id'));
  }
}
