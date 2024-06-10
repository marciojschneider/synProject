<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\PlantingMethod;

class CultivePlantingMethodController extends Controller {
  public function plantingMethods() {
    return view('content.pages.cultive.planting-method.list');
  }

  public function plantingMethodCreate() {
    return view('content.pages.cultive.planting-method.create');
  }

  public function plantingMethodCreateAction(Request $request) {
    $data = $request->only(['name', 'code', 'situation']);

    $plantingMethod = new PlantingMethod();
    $plantingMethod->name = $data['name'];
    $plantingMethod->code = $data['code'];
    $plantingMethod->situation = $data['situation'];
    $plantingMethod->save();

    return redirect()->route('cultive-methods');
  }

  public function plantingMethodUpdate(int $id) {
    $data['plantingMethod'] = PlantingMethod::find($id);

    return view('content.pages.cultive.planting-method.update', $data);
  }
  public function plantingMethodUpdateAction(int $id, Request $request) {
    $update = $request->only(['name', 'code', 'situation']);

    $plantingMethodUpdate = PlantingMethod::find($id);
    $plantingMethodUpdate->name = $update['name'];
    $plantingMethodUpdate->code = $update['code'];
    $plantingMethodUpdate->situation = $update['situation'];
    $plantingMethodUpdate->save();

    return redirect()->route('cultive-methods');
  }

  public function plantingMethodDelete(int $id) {
    PlantingMethod::where('id', $id)->delete();

    return redirect()->route('cultive-methods');
  }
}
