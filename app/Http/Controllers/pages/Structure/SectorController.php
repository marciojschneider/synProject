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
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'farm', 'situation']);

    $sector = new Sector();
    $sector->code = mb_strtoupper($data['code'], 'UTF-8');
    $sector->name = mb_strtoupper($data['name'], 'UTF-8');
    $sector->farm_id = $data['farm'];
    $sector->situation = $data['situation'];
    $sector->creation_user = $user->id;
    $sector->client_id = $user->in_client;
    $sector->save();

    return redirect()->route('structure-sectors');
  }

  public function sectorUpdate(int $id) {
    $user = auth()->user();
    $data['farms'] = Farm::where('client_id', $user->in_client)->get();

    $data['sector'] = Sector::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['sector']) {
      return redirect()->route('structure-sectors');
    }

    return view('content.pages.structure.sector.update', $data);
  }

  public function sectorUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'farm', 'situation']);
    $sectorUpdate = Sector::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$sectorUpdate) {
      return redirect()->route('structure-sectors');
    }

    $sectorUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $sectorUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $sectorUpdate->farm_id = $update['farm'];
    $sectorUpdate->situation = $update['situation'];
    $sectorUpdate->save();

    return redirect()->route('structure-sectors');
  }

  public function sectorDelete(int $id) {
    $user = auth()->user();
    Sector::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-sectors');
  }
}
