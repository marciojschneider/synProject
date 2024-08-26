<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;

class ClosureModuleController extends Controller {
  public function closureModules() {
    return view('content.pages.sys.security.closure-module.list');
  }

  public function closureModuleCreate() {
    return view('content.pages.sys.security.closure-module.create');
  }

  public function closureModuleUpdate(int $id) {
    return view('content.pages.sys.security.closure-module.update', compact('id'));
  }
}
