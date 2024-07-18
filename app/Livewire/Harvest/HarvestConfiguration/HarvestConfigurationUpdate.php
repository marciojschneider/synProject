<?php

namespace App\Livewire\Harvest\HarvestConfiguration;

use Livewire\Component;
// Models
use App\Models\Culture;
use App\Models\Field;
use App\Models\Harvest;
use App\Models\Organization;
use App\Models\PlantingMethod;
use App\Models\Section;
use App\Models\Variety;
use App\Models\HarvestConfiguration;

class HarvestConfigurationUpdate extends Component {
  // Register
  public $id, $harvest_configuration;

  // 1° Row
  public $harvests = [], $harvest, $sections = [], $section, $fields = [], $field, $cultures = [], $culture, $varieties = [], $variety, $planting_methods = [], $planting_method;
  // 2° Row
  public $planting_area, $situation, $organizations = [], $organization;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->harvest_configuration = HarvestConfiguration::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->harvest_configuration) {
      return redirect()->route('harv-configurations');
    }
    // Selects
    $this->harvests = Harvest::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->sections = Section::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->fields = Field::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->cultures = Culture::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->varieties = Variety::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->planting_methods = PlantingMethod::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->organizations = Organization::where('client_id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->harvest = $this->harvest_configuration->harvest_id;
    $this->section = $this->harvest_configuration->section_id;
    $this->field = $this->harvest_configuration->field_id;
    $this->culture = $this->harvest_configuration->culture_id;
    $this->variety = $this->harvest_configuration->variety_id;
    $this->planting_method = $this->harvest_configuration->planting_method_id;
    // 2° Row
    $this->planting_area = number_format(floatval($this->harvest_configuration->planting_area), 2, ',', '.');
    $this->situation = $this->harvest_configuration->situation;
    $this->organization = $this->harvest_configuration->organization_id;
  }

  protected $rules = [
    'harvest' => 'required',
    'section' => 'required',
    'field' => 'required',
    'culture' => 'required',
    'variety' => 'required',
    'planting_method' => 'required',
    'organization' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->harvest_configuration->harvest_id = $this->harvest;
    $this->harvest_configuration->section_id = $this->section;
    $this->harvest_configuration->field_id = $this->field;
    $this->harvest_configuration->culture_id = $this->culture;
    $this->harvest_configuration->variety_id = $this->variety;
    $this->harvest_configuration->culture_id = $this->culture;
    $this->harvest_configuration->planting_method_id = $this->planting_method;
    $this->harvest_configuration->organization_id = $this->organization;
    $this->harvest_configuration->planting_area = $this->formatNumberValue($this->planting_area);
    $this->harvest_configuration->situation = $this->situation;
    $this->harvest_configuration->save();

    return redirect()->route('harv-configurations');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
