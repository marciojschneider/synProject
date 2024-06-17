<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culture;

class CultiveCultureController extends Controller {
  public function cultures() {
    return view("content.pages.cultive.culture.list");
  }

  public function cultureCreate() {
    return view("content.pages.cultive.culture.create");
  }

  public function cultureCreateAction(Request $request) {
    $data = $request->only(['code', 'name']);

    $culture = new Culture();
    $culture->code = strtoupper($data['code']);
    $culture->name = strtoupper($data['name']);
    $culture->save();

    return redirect()->route('cultive-cultures');
  }

  public function cultureUpdate(int $id) {
    $data['culture'] = Culture::find($id);
    return view('content.pages.cultive.culture.update', $data);
  }

  public function cultureUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name']);

    $cultureUpdate = Culture::find($id);
    $cultureUpdate->code = strtoupper($update['code']);
    $cultureUpdate->name = strtoupper($update['name']);
    $cultureUpdate->save();

    return redirect()->route('cultive-cultures');
  }

  public function cultureDelete(int $id) {
    Culture::where('id', $id)->delete();
    return redirect()->route('cultive-cultures');
  }
}
