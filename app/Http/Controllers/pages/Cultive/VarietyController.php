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
    return view('content.pages.cultive.variety.create');
  }

  public function varietyCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'culture', 'group', 'situation']);

    $variety = new Variety();
    $variety->code = mb_strtoupper($data['code'], 'UTF-8');
    $variety->name = mb_strtoupper($data['name'], 'UTF-8');
    $variety->culture_id = $data['culture'];
    $variety->group_id = $data['group'];
    $variety->situation = $data['situation'];
    $variety->save();

    return redirect()->route('cultive-varieties');
  }

  public function varietyUpdate(int $id) {
    $user = auth()->user();
    $data['cultures'] = Culture::where('client_id', $user->in_client)->where('situation', 1)->get();
    $data['groups'] = Group::where('client_id', $user->in_client)->where('situation', 1)->get();

    $data['variety'] = Variety::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['variety']) {
      return redirect()->route('cultive-varieties');
    }

    return view('content.pages.cultive.variety.update', $data);
  }

  public function varietyUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'culture', 'group', 'situation']);
    $varietyUpdate = Variety::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$varietyUpdate) {
      return redirect()->route('cultive-varieties');
    }

    $varietyUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $varietyUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $varietyUpdate->culture_id = $update['culture'];
    $varietyUpdate->group_id = $update['group'];
    $varietyUpdate->situation = $update['situation'];
    $varietyUpdate->save();

    return redirect()->route('cultive-varieties');
  }

  public function varietyDelete(int $id) {
    $user = auth()->user();
    Variety::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-varieties');
  }
}
