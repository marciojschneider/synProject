<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller {
  public function sectors() {
    return view('content.pages.structure.sector.list');
  }

  public function sectorCreate() {
    $user = auth()->user();
    $data['farms'] = Farm::where('client_id', $user->in_client)->where('situation', 1)->get();

    return view('content.pages.structure.sector.create', $data);
  }

  public function sectorCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'farm', 'situation']);

    $sector = new Sector();
    $sector->code = strtoupper($data['code']);
    $sector->name = strtoupper($data['name']);
    $sector->farm_id = $data['farm'];
    $sector->situation = $data['situation'];
    $sector->save();

    return redirect()->route('structure-sectors');
  }

  public function sectorUpdate(int $id) {
    $user = auth()->user();
    $data['farms'] = Farm::where('client_id', $user->in_client)->get();

    $data['sector'] = Sector::find($id);

    if (!$data['sector']) {
      return redirect()->route('structure-sectors');
    }

    return view('content.pages.structure.sector.update', $data);
  }

  public function sectorUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'farm', 'situation']);

    $sectorUpdate = Sector::find($id);
    $sectorUpdate->code = strtoupper($update['code']);
    $sectorUpdate->name = strtoupper($update['name']);
    $sectorUpdate->farm_id = $update['farm'];
    $sectorUpdate->situation = $update['situation'];
    $sectorUpdate->save();

    return redirect()->route('structure-sectors');
  }
}
