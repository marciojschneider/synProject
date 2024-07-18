<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;
// Models
use App\Models\Client;
use App\Models\Profile;

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

  public function profileDelete(int $id) {
    $user = auth()->user();
    Profile::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-profiles');
  }
}
