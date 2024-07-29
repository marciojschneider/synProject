<?php

namespace App\Livewire\Cultive\MachineHour;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\MachineHour;
use App\Models\Harvest;
use App\Models\Organization;
use App\Models\Section;
use App\Models\Field;
use App\Models\Process;

class MachineHourList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  public $searchText;
  public $pPage = 10;

  public $filters;

  public $organizations = [];
  #[Session] public $organization = null;

  public $harvests = [];
  #[Session] public $harvest = null;

  public $sections = [];
  #[Session] public $section = null;

  public $fields = [];
  #[Session] public $field = null;

  public $processes = [];
  #[Session] public $process = null;

  // Filters
  #[Session] public $advanced_filters = false;


  public function mount() {
    $user = auth()->user();

    $this->organizations = Organization::where('client_id', $user->in_client)->get();
    $this->harvests = Harvest::where('client_id', $user->in_client)->get();
    $this->sections = Section::where('client_id', $user->in_client)->get();
    $this->fields = Field::where('client_id', $user->in_client)->get();
    $this->processes = Process::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = MachineHour::query();

    $query->join('organizations', 'organizations.id', '=', 'machine_hours.organization_id');
    $query->join('harvests', 'harvests.id', '=', 'machine_hours.harvest_id');
    $query->join('sections', 'sections.id', '=', 'machine_hours.section_id');
    $query->join('fields', 'fields.id', '=', 'machine_hours.field_id');
    $query->join('processes', 'processes.id', '=', 'machine_hours.process_id');

    if ($this->searchText) {
      $query->where('machine_hours.report', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('machine_hours.*', 'harvests.code as cHarvest', 'organizations.code as cOrganization', 'sections.code as cSection', 'sections.name as nSection',
      'fields.code as cField', 'processes.code as cProcess', 'processes.name as nProcess');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.cultive.machine-hour.machine-hour-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->organization = null;
    $this->harvest = null;
    $this->section = null;
    $this->field = null;
    $this->process = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->organization) {
        $query->where('machine_hours.organization_id', $this->organization);
      }
      if ($this->harvest) {
        $query->where('machine_hours.harvest_id', $this->harvest);
      }
      if ($this->section) {
        $query->where('machine_hours.section_id', $this->section);
      }
      if ($this->field) {
        $query->where('machine_hours.field_id', $this->field);
      }
      if ($this->process) {
        $query->where('machine_hours.process_id', $this->process);
      }
    }
  }
}
