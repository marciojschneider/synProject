<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

class SectionController extends Controller {
  public function sections() {
    return view('content.pages.structure.section.list');
  }

  public function sectionCreate() {
    return view('content.pages.structure.section.create');
  }

  public function sectionUpdate(int $id) {
    return view('content.pages.structure.section.update', compact('id'));
  }
}
