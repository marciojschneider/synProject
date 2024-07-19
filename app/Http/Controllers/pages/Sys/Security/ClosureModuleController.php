<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;
// Models
use App\Models\closureModule;

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

  public function closureModuleDelete(int $id) {
    $user = auth()->user();
    closureModule::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-closures');
  }
}
