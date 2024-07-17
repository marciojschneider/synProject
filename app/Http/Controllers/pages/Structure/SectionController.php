<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Section;

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

  public function sectionDelete(int $id) {
    $user = auth()->user();
    Section::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-sections');
  }
}
