<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Culture;

class CultureController extends Controller {
  public function cultures() {
    return view("content.pages.cultive.culture.list");
  }

  public function cultureCreate() {
    return view("content.pages.cultive.culture.create");
  }

  public function cultureCreateAction(Request $request) {
    $data = $request->only(['code', 'name']);

    $culture = new Culture();
    $culture->code = mb_strtoupper($data['code'], 'UTF-8');
    $culture->name = mb_strtoupper($data['name'], 'UTF-8');
    $culture->save();

    return redirect()->route('cultive-cultures');
  }

  public function cultureUpdate(int $id) {
    $user = auth()->user();
    $data['culture'] = Culture::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['culture']) {
      return redirect()->route('cultive-cultures');
    }

    return view('content.pages.cultive.culture.update', $data);
  }

  public function cultureUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name']);
    $cultureUpdate = Culture::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$cultureUpdate) {
      return redirect()->route('cultive-cultures');
    }

    $cultureUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $cultureUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $cultureUpdate->save();

    return redirect()->route('cultive-cultures');
  }

  public function cultureDelete(int $id) {
    $user = auth()->user();
    Culture::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-cultures');
  }
}
