<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

class SectorController extends Controller {
  public function sectors() {
    return view('content.pages.structure.sector.list');
  }

  public function sectorCreate() {
    return view('content.pages.structure.sector.create');
  }

  public function sectorUpdate(int $id) {
    return view('content.pages.structure.sector.update', compact('id'));
  }
}
