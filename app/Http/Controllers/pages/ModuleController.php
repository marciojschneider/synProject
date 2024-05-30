<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Sidebar;
use Illuminate\Http\Request;

class ModuleController extends Controller {
  public function modules() {
    return view('content.pages.module.list');
  }

  public function moduleCreate() {
    $data['modules'] = Sidebar::where('icon', null)->get();

    return view('content.pages.module.create', $data);
  }

  public function moduleCreateAction(Request $request) {
    dd($request);
  }
}
