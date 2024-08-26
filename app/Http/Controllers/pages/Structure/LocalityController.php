<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

class LocalityController extends Controller {
  public function localities() {
    return view('content.pages.structure.locality.list');
  }

  public function localityCreate() {
    return view('content.pages.structure.locality.create');
  }

  public function localityUpdate(int $id) {
    return view('content.pages.structure.locality.update', compact('id'));
  }
}
