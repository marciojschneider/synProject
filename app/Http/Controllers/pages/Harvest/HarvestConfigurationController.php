<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;

class HarvestConfigurationController extends Controller {
  public function harvestConfigurations() {
    return view('content.pages.harvest.harvest-configuration.list');
  }

  public function harvestConfigurationCreate() {
    return view('content.pages.harvest.harvest-configuration.create');
  }

  public function harvestConfigurationUpdate(int $id) {
    return view('content.pages.harvest.harvest-configuration.update', compact('id'));
  }
}
