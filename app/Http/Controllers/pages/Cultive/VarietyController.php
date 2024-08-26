<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

class VarietyController extends Controller {
  public function varieties() {
    return view('content.pages.cultive.variety.list');
  }

  public function varietyCreate() {
    return view('content.pages.cultive.variety.create');
  }

  public function varietyUpdate(int $id) {
    return view('content.pages.cultive.variety.update', compact('id'));
  }
}
