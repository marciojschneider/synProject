<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Harvest;

class HarvHarvestController extends Controller {
  public function harvests() {
    return view('content.pages.harv.harvest.list');
  }

  public function harvestCreate() {
    return view('content.pages.harv.harvest.create');
  }
  public function harvestCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'price_table', 'initial_dt', 'ending_dt', 'situation']);

    $harvest = new Harvest();
    $harvest->code = strtoupper($data['code']);
    $harvest->name = strtoupper($data['name']);
    $harvest->price_table = $data['price_table'];
    $harvest->initial_dt = $data['initial_dt'];
    $harvest->ending_dt = $data['ending_dt'];
    $harvest->situation = $data['situation'];
    $harvest->save();

    return redirect()->route('harv-harvests');
  }
  public function harvestUpdate(int $id) {
    $data['harvest'] = Harvest::find($id);
    return view('content.pages.harv.harvest.update', $data);
  }

  public function harvestUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'price_table', 'initial_dt', 'ending_dt', 'situation']);

    $harvestUpdate = Harvest::find($id);
    $harvestUpdate->code = strtoupper($update['code']);
    $harvestUpdate->name = strtoupper($update['name']);
    $harvestUpdate->price_table = $update['price_table'];
    $harvestUpdate->initial_dt = $update['initial_dt'];
    $harvestUpdate->ending_dt = $update['ending_dt'];
    $harvestUpdate->situation = $update['situation'];
    $harvestUpdate->save();

    return redirect()->route('harv-harvests');
  }

  public function harvestDelete(int $id) {
    Harvest::where('id', $id)->delete();
    return redirect()->route('harv-harvests');
  }

}
