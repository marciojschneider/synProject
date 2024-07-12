<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
// Models
use App\Models\Group;

class GroupController extends Controller {

  public function groups() {
    return view('content.pages.cultive.group.list');
  }

  public function groupCreate() {
    return view('content.pages.cultive.group.create');
  }

  public function groupUpdate(int $id) {
    return view('content.pages.cultive.group.update', compact('id'));
  }

  public function groupDelete(int $id) {
    $user = auth()->user();
    Group::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-groups');
  }
}
