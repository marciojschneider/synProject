<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

class ProcessController extends Controller {

  public function processes() {
    return view('content.pages.cultive.process.list');
  }

  public function processCreate() {
    return view('content.pages.cultive.process.create');
  }

  public function processUpdate(int $id) {
    return view('content.pages.cultive.process.update', compact('id'));
  }
}
