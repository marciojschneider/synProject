<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;

class StructureFarmController extends Controller {
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
    $data["farm"] = Farm::find($id);
    return view("content.pages.structure.farm.update", $data);
  }

  public function farmUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'property', 'owner', 'situation']);

    $farmUpdate = Farm::find($id);
    $farmUpdate->code = strtoupper($update['code']);
    $farmUpdate->name = strtoupper($update['name']);
    $farmUpdate->property = $update['property'];
    $farmUpdate->owner = $update['owner'];
    $farmUpdate->situation = $update['situation'];
    $farmUpdate->save();

    return redirect()->route('structure-farms');
  }

  public function farmDelete(int $id) {
    Farm::where('id', $id)->delete();
    return redirect()->route('structure-farms');
  }
}
