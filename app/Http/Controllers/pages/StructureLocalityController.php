<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Locality;

class StructureLocalityController extends Controller {
  public function localities() {
    return view('content.pages.structure.locality.list');
  }

  public function localityCreate() {
    return view('content.pages.structure.locality.create');
  }

  public function localityCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'situation']);

    $locality = new Locality();

    $locality->code = $data['code'];
    $locality->name = $data['name'];
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

    $localityUpdate->code = $update['code'];
    $localityUpdate->name = $update['name'];
    $localityUpdate->situation = $update['situation'];
    $localityUpdate->save();

    return redirect()->route('structure-localities');
  }

  public function localityDelete(int $id) {
    Locality::where('id', $id)->delete();

    return redirect()->route('structure-localities');
  }
}
