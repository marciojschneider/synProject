<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;
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

  public function harvestDelete(int $id) {
    $user = auth()->user();
    Harvest::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('harv-harvests');
  }
}
