<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
// Models
use App\Models\PlantingMethod;

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

  public function plantingMethodDelete(int $id) {
    $user = auth()->user();
    PlantingMethod::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-methods');
  }
}
