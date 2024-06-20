<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Locality;

class LocalityController extends Controller {
  public function localities() {
    return view('content.pages.structure.locality.list');
  }

  public function localityCreate() {
    return view('content.pages.structure.locality.create');
  }

  public function localityCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'situation']);

    $locality = new Locality();
    $locality->code = strtoupper($data['code']);
    $locality->name = strtoupper($data['name']);
    $locality->situation = $data['situation'];
    $locality->save();

    return redirect()->route('structure-localities');
  }

  public function localityUpdate(int $id) {
    $data['locality'] = Locality::find($id);

    return view('content.pages.structure.locality.update', $data);
  }

  public function localityUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'situation']);

    $localityUpdate = Locality::find($id);
    $localityUpdate->code = strtoupper($update['code']);
    $localityUpdate->name = strtoupper($update['name']);
    $localityUpdate->situation = $update['situation'];
    $localityUpdate->save();

    return redirect()->route('structure-localities');
  }

  public function localityDelete(int $id) {
    Locality::where('id', $id)->delete();

    return redirect()->route('structure-localities');
  }
}
