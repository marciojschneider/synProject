<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

class PlantingMethodController extends Controller {
  public function plantingMethods() {
    return view('content.pages.cultive.planting-method.list');
  }

  public function plantingMethodCreate() {
    return view('content.pages.cultive.planting-method.create');
  }

  public function plantingMethodUpdate(int $id) {
    return view('content.pages.cultive.planting-method.update', compact('id'));
  }
}
