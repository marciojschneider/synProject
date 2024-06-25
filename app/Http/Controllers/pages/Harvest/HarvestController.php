<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Harvest;

class HarvestController extends Controller {
  public function harvests() {
    return view('content.pages.harv.harvest.list');
  }

  public function harvestCreate() {
    return view('content.pages.harv.harvest.create');
  }
  public function harvestCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'price_table', 'initial_dt', 'ending_dt', 'situation']);

    $harvest = new Harvest();
    $harvest->code = mb_strtoupper($data['code'], 'UTF-8');
    $harvest->name = mb_strtoupper($data['name'], 'UTF-8');
    $harvest->price_table = $data['price_table'];
    $harvest->initial_dt = $data['initial_dt'];
    $harvest->ending_dt = $data['ending_dt'];
    $harvest->situation = $data['situation'];
    $harvest->creation_user = $user->id;
    $harvest->client_id = $user->in_client;
    $harvest->save();

    return redirect()->route('harv-harvests');
  }
  public function harvestUpdate(int $id) {
    $user = auth()->user();
    $data['harvest'] = Harvest::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['harvest']) {
      return redirect()->route('harv-harvests');
    }

    return view('content.pages.harv.harvest.update', $data);
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
