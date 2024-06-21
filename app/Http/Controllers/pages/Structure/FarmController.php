<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller {
  public function farms() {
    return view("content.pages.structure.farm.list");
  }

  public function farmCreate() {
    return view("content.pages.structure.farm.create");
  }

  public function farmCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'property', 'owner', 'situation']);

    $farm = new Farm();
    $farm->code = strtoupper($data['code']);
    $farm->name = strtoupper($data['name']);
    $farm->property = $data['property'];
    $farm->owner = $data['owner'];
    $farm->situation = $data['situation'];
    $farm->save();

    return redirect()->route('structure-farms');
  }

  public function farmUpdate(int $id) {
    $user = auth()->user();
    $data['farm'] = Farm::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['farm']) {
      return redirect()->route('structure-farms');
    }

    return view("content.pages.structure.farm.update", $data);
  }

  public function farmUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'property', 'owner', 'situation']);
    $farmUpdate = Farm::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$farmUpdate) {
      return redirect()->route('structure-farms');
    }

    $farmUpdate->code = strtoupper($update['code']);
    $farmUpdate->name = strtoupper($update['name']);
    $farmUpdate->property = $update['property'];
    $farmUpdate->owner = $update['owner'];
    $farmUpdate->situation = $update['situation'];
    $farmUpdate->save();

    return redirect()->route('structure-farms');
  }

  public function farmDelete(int $id) {
    $user = auth()->user();
    Farm::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-farms');
  }
}
