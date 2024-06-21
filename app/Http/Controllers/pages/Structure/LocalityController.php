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
    $user = auth()->user();
    $data['locality'] = Locality::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['locality']) {
      return redirect()->route('structure-localities');
    }

    return view('content.pages.structure.locality.update', $data);
  }

  public function localityUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'situation']);
    $localityUpdate = Locality::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$localityUpdate) {
      return redirect()->route('structure-localities');
    }

    $localityUpdate->code = strtoupper($update['code']);
    $localityUpdate->name = strtoupper($update['name']);
    $localityUpdate->situation = $update['situation'];
    $localityUpdate->save();

    return redirect()->route('structure-localities');
  }

  public function localityDelete(int $id) {
    $user = auth()->user();
    Locality::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-localities');
  }
}
