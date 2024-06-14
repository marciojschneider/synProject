<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Sector;
use Illuminate\Http\Request;

class StructureSectorController extends Controller {
  public function sectors() {
    return view('content.pages.structure.sector.list');
  }

  public function sectorCreate() {
    $data['farms'] = Farm::all();

    return view('content.pages.structure.sector.create', $data);
  }

  public function sectorCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'farm', 'situation']);

    $sector = new Sector();

    $sector->code = $data['code'];
    $sector->name = $data['name'];
    $sector->farm_id = $data['farm'];
    $sector->situation = $data['situation'];

    $sector->save();

    return redirect()->route('structure-sectors');
  }

  public function sectorUpdate(int $id) {
    $data['farms'] = Farm::all();
    $data['sector'] = Sector::find($id);

    return view('content.pages.structure.sector.update', $data);
  }

  public function sectorUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'farm', 'situation']);

    $sectorUpdate = Sector::find($id);

    $sectorUpdate->code = $update['code'];
    $sectorUpdate->name = $update['name'];
    $sectorUpdate->farm_id = $update['farm'];
    $sectorUpdate->situation = $update['situation'];

    $sectorUpdate->save();

    return redirect()->route('structure-sectors');
  }
}
