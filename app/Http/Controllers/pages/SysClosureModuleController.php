<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Sidebar;
use App\Models\closureModule;

class SysClosureModuleController extends Controller {
  public function closureModules() {
    return view('content.pages.sys.closure-module.list');
  }

  public function closureModuleCreate() {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    return view('content.pages.sys.closure-module.create', $data);
  }

  public function closureModuleCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['sidebar', 'dt_closure', 'situation']);

    $closureModule = new closureModule();
    $closureModule->sidebar_id = $data['sidebar'];
    $closureModule->client_id = $user->in_client;
    $closureModule->dt_closure = $data['dt_closure'];
    $closureModule->situation = $data['situation'];
    $closureModule->save();

    return redirect()->route('sys-closures');
  }

  public function closureModuleUpdate(int $id) {
    $data['closure_module'] = closureModule::find($id);
    $data['sidebars'] = Sidebar::where('icon', null)->get();

    return view('content.pages.sys.closure-module.update', $data);
  }

  public function closureModuleUpdateAction(int $id, Request $request) {
    $update = $request->only(['sidebar', 'dt_closure', 'situation']);

    $closureModuleUpdate = closureModule::find($id);
    $closureModuleUpdate->sidebar_id = $update['sidebar'];
    $closureModuleUpdate->dt_closure = $update['dt_closure'];
    $closureModuleUpdate->situation = $update['situation'];
    $closureModuleUpdate->save();

    return redirect()->route('sys-closures');
  }

  public function closureModuleDelete(int $id) {
    closureModule::where('id', $id)->delete();

    return redirect()->route('sys-closures');
  }
}
