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

class HarvestConfigurationCreate extends Component {
  // Selects
  public $harvests, $sections, $fields, $cultures, $varieties, $planting_methods, $organizations;
  // 1° Row
  public $harvest, $section, $field, $culture, $variety, $planting_method;
  // 2° Row
  public $planting_area, $situation = 1, $organization;

  public function mount() {
    $user = auth()->user();
    $this->harvests = Harvest::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->sections = Section::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->fields = Field::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->cultures = Culture::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->varieties = Variety::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->planting_methods = PlantingMethod::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->organizations = Organization::where('client_id', $user->in_client)->where('situation', 1)->get();
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
    $user = auth()->user();
    $this->validate();

    $harvest_configuration = new HarvestConfiguration();
    $harvest_configuration->harvest_id = $this->harvest;
    $harvest_configuration->section_id = $this->section;
    $harvest_configuration->field_id = $this->field;
    $harvest_configuration->culture_id = $this->culture;
    $harvest_configuration->variety_id = $this->variety;
    $harvest_configuration->culture_id = $this->culture;
    $harvest_configuration->planting_method_id = $this->planting_method;
    $harvest_configuration->organization_id = $this->organization;
    $harvest_configuration->planting_area = $this->formatNumberValue($this->planting_area);
    $harvest_configuration->situation = $this->situation;
    $harvest_configuration->creation_user = $user->id;
    $harvest_configuration->client_id = $user->in_client;
    $harvest_configuration->save();

    return redirect()->route('harv-configurations');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
