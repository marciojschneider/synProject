<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Harvest;

class HarvestController extends Controller {
  public function harvests() {
    return view('content.pages.harvest.harvest.list');
  }

  public function harvestCreate() {
    return view('content.pages.harvest.harvest.create');
  }

  public function harvestUpdate(int $id) {
    return view('content.pages.harvest.harvest.update', compact('id'));
  }

  public function harvestUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'price_table', 'initial_dt', 'ending_dt', 'situation']);
    $harvestUpdate = Harvest::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$harvestUpdate) {
      return redirect()->route('harv-harvests');
    }

    $harvestUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $harvestUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $harvestUpdate->price_table = $update['price_table'];
    $harvestUpdate->initial_dt = $update['initial_dt'];
    $harvestUpdate->ending_dt = $update['ending_dt'];
    $harvestUpdate->situation = $update['situation'];
    $harvestUpdate->save();

    return redirect()->route('harv-harvests');
  }

  public function harvestDelete(int $id) {
    $user = auth()->user();
    Harvest::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('harv-harvests');
  }

}
