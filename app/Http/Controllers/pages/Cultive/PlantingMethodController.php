<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\PlantingMethod;

class PlantingMethodController extends Controller {
  public function plantingMethods() {
    return view('content.pages.cultive.planting-method.list');
  }

  public function plantingMethodCreate() {
    return view('content.pages.cultive.planting-method.create');
  }

  public function plantingMethodCreateAction(Request $request) {
    $data = $request->only(['name', 'code', 'situation']);

    $plantingMethod = new PlantingMethod();
    $plantingMethod->name = mb_strtoupper($data['name'], 'UTF-8');
    $plantingMethod->code = mb_strtoupper($data['code'], 'UTF-8');
    $plantingMethod->situation = $data['situation'];
    $plantingMethod->save();

    return redirect()->route('cultive-methods');
  }

  public function plantingMethodUpdate(int $id) {
    $user = auth()->user();
    $data['plantingMethod'] = PlantingMethod::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['plantingMethod']) {
      return redirect()->route('cultive-methods');
    }

    return view('content.pages.cultive.planting-method.update', $data);
  }
  public function plantingMethodUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['name', 'code', 'situation']);
    $plantingMethodUpdate = PlantingMethod::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$plantingMethodUpdate) {
      return redirect()->route('cultive-methods');
    }

    $plantingMethodUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $plantingMethodUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $plantingMethodUpdate->situation = $update['situation'];
    $plantingMethodUpdate->save();

    return redirect()->route('cultive-methods');
  }

  public function plantingMethodDelete(int $id) {
    $user = auth()->user();
    PlantingMethod::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-methods');
  }
}
