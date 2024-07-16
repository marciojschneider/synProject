<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Farm;

class FarmController extends Controller {
  public function farms() {
    return view("content.pages.structure.farm.list");
  }

  public function farmCreate() {
    return view("content.pages.structure.farm.create");
  }

  public function farmUpdate(int $id) {
    return view("content.pages.structure.farm.update", compact('id'));
  }

  public function farmDelete(int $id) {
    $user = auth()->user();
    Farm::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-farms');
  }
}
