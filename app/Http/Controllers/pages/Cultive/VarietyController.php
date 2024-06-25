<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Culture;
use App\Models\Variety;
use App\Models\Group;

class VarietyController extends Controller {
  public function varieties() {
    return view('content.pages.cultive.variety.list');
  }

  public function varietyCreate() {
    $data['cultures'] = Culture::all();
    $data['groups'] = Group::all();

    return view('content.pages.cultive.variety.create', $data);
  }

  public function varietyCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'culture', 'group', 'situation']);

    $variety = new Variety();
    $variety->code = strtoupper($data['code']);
    $variety->name = strtoupper($data['name']);
    $variety->culture_id = $data['culture'];
    $variety->group_id = $data['group'];
    $variety->situation = $data['situation'];
    $variety->save();

    return redirect()->route('cultive-varieties');
  }

  public function varietyUpdate(int $id) {
    $data['cultures'] = Culture::all();
    $data['groups'] = Group::all();

    $data['variety'] = Variety::find($id);

    return view('content.pages.cultive.variety.update', $data);
  }

  public function varietyUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'culture', 'group', 'situation']);

    $varietyUpdate = Variety::find($id);
    $varietyUpdate->code = strtoupper($update['code']);
    $varietyUpdate->name = strtoupper($update['name']);
    $varietyUpdate->culture_id = $update['culture'];
    $varietyUpdate->group_id = $update['group'];
    $varietyUpdate->situation = $update['situation'];
    $varietyUpdate->save();

    return redirect()->route('cultive-varieties');
  }

  public function varietyDelete(int $id) {
    Variety::where('id', $id)->delete();

    return redirect()->route('cultive-varieties');
  }
}
