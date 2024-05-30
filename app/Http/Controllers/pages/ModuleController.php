<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller {
  public function modules() {
    return view('content.pages.module.list');
  }

  public function moduleCreate() {
    return view('content.pages.module.create');
  }

  public function moduleCreateAction(Request $request) {
    dd($request);
  }
}
