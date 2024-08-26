<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

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
}
