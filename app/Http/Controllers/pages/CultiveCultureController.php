<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culture;

class CultiveCultureController extends Controller {
  public function cultures() {
    return view("content.pages.culture.list");
  }

  public function cultureCreate() {
    return view("content.pages.culture.create");
  }

  public function cultureCreateAction(Request $request) {
    $data = $request->only(['code', 'name']);

    $culture = new Culture();

    $culture->code = $data['code'];
    $culture->name = $data['name'];

    $culture->save();

    return redirect()->route('structure-cultures');
  }

  public function cultureUpdate(int $id) {
    $data['culture'] = Culture::find($id);
    return view('content.pages.culture.update', $data);
  }

  public function cultureUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name']);
    $cultureUpdate = Culture::find($id);

    $cultureUpdate->code = $update['code'];
    $cultureUpdate->name = $update['name'];

    $cultureUpdate->save();

    return redirect()->route('structure-cultures');
  }

  public function cultureDelete(int $id) {
    Culture::where('id', $id)->delete();
    return redirect()->route('structure-cultures');
  }
}
