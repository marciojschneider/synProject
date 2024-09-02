<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;

class SidebarController extends Controller {
  public function sidebars() {
    return view('content.pages.sys.sidebar.list');
  }

  public function sidebarCreate() {
    return view('content.pages.sys.sidebar.create');
  }

  public function sidebarUpdate(int $id) {
    return view('content.pages.sys.sidebar.update', compact('id'));
  }
}
