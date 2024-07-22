<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;
// Models
use App\Models\User;

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

  public function userDelete(int $id) {
    $user = auth()->user();

    User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('users.id', $id)
      ->where('user_profiles.client_id', $user->in_client)->delete();

    return redirect()->route('sys-users');
  }
}
