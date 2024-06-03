<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Harvest;

class HarvestController extends Controller {
  public function harvests() {
    return view('content.pages.harvest.list');
  }

  public function harvestCreate() {
    return view('content.pages.harvest.create');
  }
  public function harvestCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'price_table', 'initial_dt', 'ending_dt', 'situation']);
    $harvest = new Harvest();

    $harvest->code = $data['code'];
    $harvest->name = $data['name'];
    $harvest->price_table = $data['price_table'];
    $harvest->initial_dt = $data['initial_dt'];
    $harvest->ending_dt = $data['ending_dt'];
    $harvest->situation = $data['situation'];

    $harvest->save();

    return redirect()->route('structure-harvests');
  }

}
