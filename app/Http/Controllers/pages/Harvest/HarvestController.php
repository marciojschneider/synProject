<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;

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
}
