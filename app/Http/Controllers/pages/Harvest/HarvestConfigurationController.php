<?php

namespace App\Http\Controllers\pages\Harvest;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use App\Models\Field;
use App\Models\Harvest;
use App\Models\HarvestConfiguration;
use App\Models\Organization;
use App\Models\PlantingMethod;
use App\Models\Section;
use App\Models\Variety;
use Illuminate\Http\Request;

class HarvestConfigurationController extends Controller {
  public function harvestConfigurations() {
    return view('content.pages.harv.harvest-configuration.list');
  }

  public function getData() {
    $user = auth()->user();
    $data['harvests'] = Harvest::where('client_id', $user->in_client)->get();
    $data['sections'] = Section::where('client_id', $user->in_client)->get();
    $data['fields'] = Field::where('client_id', $user->in_client)->get();
    $data['cultures'] = Culture::where('client_id', $user->in_client)->get();
    $data['varieties'] = Variety::where('client_id', $user->in_client)->get();
    $data['planting_methods'] = PlantingMethod::where('client_id', $user->in_client)->get();
    $data['organizations'] = Organization::where('client_id', $user->in_client)->get();

    return $data;
  }

  public function harvestConfigurationCreate() {
    $data = $this->getData();

    return view('content.pages.harv.harvest-configuration.create', $data);
  }

  public function harvestConfigurationCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['harvest', 'section', 'field', 'culture', 'variety', 'planting_method', 'planting_area', 'situation', 'organization']);

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatPlanting = implode('', explode('.', $data['planting_area']));

    $harvestConfiguration = new HarvestConfiguration();
    $harvestConfiguration->harvest_id = $data['harvest'];
    $harvestConfiguration->section_id = $data['section'];
    $harvestConfiguration->field_id = $data['field'];
    $harvestConfiguration->culture_id = $data['culture'];
    $harvestConfiguration->variety_id = $data['variety'];
    $harvestConfiguration->planting_method_id = $data['planting_method'];
    $harvestConfiguration->planting_area = number_format(floatval(implode('.', explode(',', $formatPlanting))), 2, '.', '');
    $harvestConfiguration->situation = $data['situation'];
    $harvestConfiguration->organization_id = $data['organization'];
    $harvestConfiguration->creation_user = $user->id;
    $harvestConfiguration->client_id = $user->in_client;
    $harvestConfiguration->save();

    return redirect()->route('harv-configurations');
  }

  public function harvestConfigurationUpdate(int $id) {
    $data = $this->getData();

    $data['harvestConfiguration'] = HarvestConfiguration::find($id);

    return view('content.pages.harv.harvest-configuration.update', $data);
  }

  public function harvestConfigurationUpdateAction(int $id, Request $request) {
    $update = $request->only(['harvest', 'section', 'field', 'culture', 'variety', 'planting_method', 'planting_area', 'situation', 'organization']);

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatPlanting = implode('', explode('.', $update['planting_area']));

    $harvestConfigurationUpdate = HarvestConfiguration::find($id);
    $harvestConfigurationUpdate->harvest_id = $update['harvest'];
    $harvestConfigurationUpdate->section_id = $update['section'];
    $harvestConfigurationUpdate->field_id = $update['field'];
    $harvestConfigurationUpdate->culture_id = $update['culture'];
    $harvestConfigurationUpdate->variety_id = $update['variety'];
    $harvestConfigurationUpdate->planting_method_id = $update['planting_method'];
    $harvestConfigurationUpdate->planting_area = number_format(floatval(implode('.', explode(',', $formatPlanting))), 2, '.', '');
    $harvestConfigurationUpdate->situation = $update['situation'];
    $harvestConfigurationUpdate->organization_id = $update['organization'];
    $harvestConfigurationUpdate->save();

    return redirect()->route('harv-configurations');
  }

  public function harvestConfigurationDelete(int $id) {
    HarvestConfiguration::where('id', $id)->delete();

    return redirect()->route('harv-configurations');
  }
}
