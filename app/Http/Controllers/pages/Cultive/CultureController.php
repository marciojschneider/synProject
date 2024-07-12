<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
// Models
use App\Models\Culture;

class CultureController extends Controller {
  public function cultures() {
    return view("content.pages.cultive.culture.list");
  }

  public function cultureCreate() {
    return view("content.pages.cultive.culture.create");
  }

  public function cultureUpdate(int $id) {
    return view('content.pages.cultive.culture.update', compact('id'));
  }

  public function cultureDelete(int $id) {
    $user = auth()->user();
    Culture::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-cultures');
  }
}
