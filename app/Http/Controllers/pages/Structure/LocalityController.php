<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Locality;

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

  public function localityDelete(int $id) {
    $user = auth()->user();
    Locality::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-localities');
  }
}
