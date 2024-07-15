<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;
// Models
use App\Models\HarvestConfiguration;

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

  public function harvestConfigurationDelete(int $id) {
    $user = auth()->user();
    HarvestConfiguration::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('harv-configurations');
  }
}
