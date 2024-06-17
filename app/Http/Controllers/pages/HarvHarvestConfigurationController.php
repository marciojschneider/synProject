<?php

namespace App\Http\Controllers\pages;

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

class HarvHarvestConfigurationController extends Controller {
  public function harvestConfigurations() {
    return view('content.pages.harv.harvest-configuration.list');
  }

  public function harvestConfigurationCreate() {
    $data['harvests'] = Harvest::all();
    $data['sections'] = Section::all();
    $data['fields'] = Field::all();
    $data['cultures'] = Culture::all();
    $data['varieties'] = Variety::all();
    $data['planting_methods'] = PlantingMethod::all();
    $data['organizations'] = Organization::all();

    return view('content.pages.harv.harvest-configuration.create', $data);
  }

  public function harvestConfigurationCreateAction(Request $request) {
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
    $harvestConfiguration->save();

    return redirect()->route('harv-harvest-configurations');
  }

  public function harvestConfigurationUpdate(int $id) {
    $data['harvests'] = Harvest::all();
    $data['sections'] = Section::all();
    $data['fields'] = Field::all();
    $data['cultures'] = Culture::all();
    $data['varieties'] = Variety::all();
    $data['planting_methods'] = PlantingMethod::all();
    $data['organizations'] = Organization::all();

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

    return redirect()->route('harv-harvest-configurations');
  }
}
