<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;

class UserController extends Controller {
  public function users() {
    return view('content.pages.sys.user.list');
  }

  public function userCreate() {
    return view('content.pages.sys.user.create');
  }

  public function userUpdate(int $id) {
    return view('content.pages.sys.user.update', compact('id'));
  }
}
