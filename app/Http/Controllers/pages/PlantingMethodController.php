<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\PlantingMethod;

class PlantingMethodController extends Controller {
  public function plantingMethods() {
    return view('content.pages.planting-method.list');
  }

  public function plantingMethodCreate() {
    return view('content.pages.planting-method.create');
  }

  public function plantingMethodCreateAction(Request $request) {
    dd($request);
  }

  public function plantingMethodUpdate(int $id) {
    $data['plantingMethod'] = PlantingMethod::find($id);

    return view('content.pages.planting-method.update', $data);
  }
  public function plantingMethodUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function plantingMethodDelete(int $id) {
    PlantingMethod::where('id', $id)->delete();
    return redirect('cultive-methods');
  }
}
