<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SysClosureModuleController extends Controller {
  public function closureModules() {
    return view('content.pages.closure-module.list');
  }

  public function closureModuleCreate() {
    return view('content.pages.closure-module.create');
  }

  public function closureModuleCreateAction(int $id, Request $request) {
    dd($request);
  }

  public function closureModuleUpdate(int $id, Request $request) {
    return view('content.pages.closure-module.update');
  }

  public function closureModuleUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function closureModuleDelete(int $id) {
    dd($id);
  }
}
