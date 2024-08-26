<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

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
}
