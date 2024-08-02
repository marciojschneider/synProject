<?php

namespace App\Livewire\Harvest\HarvestConfiguration;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

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
  #[Session] public $searchText;
  public $pPage = 10;

  public $harvests = [];
  #[Session] public $harvest = null;

  public $sections = [];
  #[Session] public $section = null;

  public $fields = [];
  #[Session] public $field = null;

  public $cultures = [];
  #[Session] public $culture = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();
    $this->harvests = Harvest::where('client_id', $user->in_client)->get();
    $this->sections = Section::where('client_id', $user->in_client)->get();
    $this->fields = Field::where('client_id', $user->in_client)->get();
    $this->cultures = Culture::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['harvest' => $this->harvest, 'section' => $this->section, 'field' => $this->field, 'culture' => $this->culture]);

    $user = auth()->user();
    $query = HarvestConfiguration::query();

    $query->join('harvests', 'harvests.id', '=', 'harvest_configurations.harvest_id')
      ->join('sections', 'sections.id', '=', 'harvest_configurations.section_id')
      ->join('fields', 'fields.id', '=', 'harvest_configurations.field_id')
      ->join('cultures', 'cultures.id', '=', 'harvest_configurations.culture_id')
      ->join('varieties', 'varieties.id', '=', 'harvest_configurations.variety_id')
      ->join('planting_methods', 'planting_methods.id', '=', 'harvest_configurations.planting_method_id')
      ->join('organizations', 'organizations.id', '=', 'harvest_configurations.organization_id')
      ->where('harvest_configurations.client_id', $user->in_client)
      ->select('harvest_configurations.*', 'harvests.code as cHarvest', 'sections.code as cSection', 'sections.name as nSection', 'fields.code as cField', 'fields.name as nField',
        'cultures.code as cCulture', 'cultures.name as nCulture', 'varieties.code as cVariety', 'varieties.name as nVariety', 'planting_methods.code as cPlantingMethod', 'planting_methods.name as nPlantingMethod',
        'organizations.code as cOrganization')
      ->get();

    $this->addAdvancedFilters($query);

    $data['rows'] = $query->paginate($this->pPage);
    return view('livewire.harvest.harvest-configuration.harvest-configuration-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->harvest = null;
    $this->section = null;
    $this->field = null;
    $this->culture = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->harvest) {
        $query->where('harvest_configurations.harvest_id', $this->harvest);
      }

      if ($this->section) {
        $query->where('harvest_configurations.section_id', $this->section);
      }

      if ($this->field) {
        $query->where('harvest_configurations.field_id', $this->field);
      }

      if ($this->culture) {
        $query->where('harvest_configurations.culture_id', $this->culture);
      }
    }
  }
}
