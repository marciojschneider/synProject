<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Sidebar;
use App\Models\closureModule;

class SysClosureModuleController extends Controller {
  public function closureModules() {
    return view('content.pages.sys.security.closure-module.list');
  }

  public function closureModuleCreate() {
    return view('content.pages.sys.security.closure-module.create');
  }

  public function closureModuleCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['screen', 'dt_closure', 'situation']);

    $verifyUniqueClosure = closureModule::where('sidebar_id', $data['screen'])->where('client_id', $user->in_client)->first();
    if ($verifyUniqueClosure) {
      return redirect()->route('sys-sec-closures');
    }

    $closureModule = new closureModule();
    $closureModule->sidebar_id = $data['screen'];
    $closureModule->client_id = $user->in_client;
    $closureModule->dt_closure = $data['dt_closure'];
    $closureModule->situation = $data['situation'];
    $closureModule->save();

    return redirect()->route('sys-sec-closures');
  }

  public function closureModuleUpdate(int $id) {
    return view('content.pages.sys.security.closure-module.update', compact('id'));
  }

  public function closureModuleUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['screen', 'dt_closure', 'situation']);

    $verifyUniqueClosure = closureModule::where('sidebar_id', $update['screen'])->where('client_id', $user->in_client)->first();
    if ($verifyUniqueClosure) {
      return redirect()->route('sys-sec-closures');
    }

    $closureModuleUpdate = closureModule::find($id);
    $closureModuleUpdate->sidebar_id = $update['screen'];
    $closureModuleUpdate->dt_closure = $update['dt_closure'];
    $closureModuleUpdate->situation = $update['situation'];
    $closureModuleUpdate->save();

    return redirect()->route('sys-sec-closures');
  }

  public function closureModuleDelete(int $id) {
    closureModule::where('id', $id)->delete();

    return redirect()->route('sys-sec-closures');
  }
}
