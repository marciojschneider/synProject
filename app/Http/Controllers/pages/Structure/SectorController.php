<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Sector;

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

  public function sectorDelete(int $id) {
    $user = auth()->user();
    Sector::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-sectors');
  }
}
