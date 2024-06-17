<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Culture;
use App\Models\Field;
use App\Models\Harvest;
use App\Models\HarvestConfiguration;
use App\Models\Section;

class HarvestConfigurationList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  public $searchText;
  public $pPage = 10;

  public $harvests = [];
  public $harvest;

  public $sections = [];
  public $section;

  public $fields = [];
  public $field;

  public $cultures = [];
  public $culture;

  public function mount() {
    $this->harvests = Harvest::all();
    $this->sections = Section::all();
    $this->fields = Field::all();
    $this->cultures = Culture::all();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = HarvestConfiguration::query();

    $query->join('harvests', 'harvests.id', '=', 'harvest_configurations.harvest_id')
      ->join('sections', 'sections.id', '=', 'harvest_configurations.section_id')
      ->join('fields', 'fields.id', '=', 'harvest_configurations.field_id')
      ->join('cultures', 'cultures.id', '=', 'harvest_configurations.culture_id')
      ->join('varieties', 'varieties.id', '=', 'harvest_configurations.variety_id')
      ->join('planting_methods', 'planting_methods.id', '=', 'harvest_configurations.planting_method_id')
      ->join('organizations', 'organizations.id', '=', 'harvest_configurations.organization_id')
      ->select('harvest_configurations.*', 'harvests.code as cHarvest', 'sections.name as nSection', 'fields.name as nField',
        'cultures.name as nCulture', 'varieties.name as nVariety', 'planting_methods.name as nPlantingMethod', 'organizations.name as nOrganization')
      ->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.harvest-configuration-list', $data);
  }
}
