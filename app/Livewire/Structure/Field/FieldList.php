<?php

namespace App\Livewire\Structure\Field;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Field;
use App\Models\Farm;
use App\Models\Locality;

class FieldList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;

  public $farms = [];
  #[Session] public $farm = null;

  public $localities = [];
  #[Session] public $locality = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->farms = Farm::where('client_id', $user->in_client)->get();
    $this->localities = Locality::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = Field::query();

    $query->join('farms', 'farms.id', '=', 'fields.farm_id');

    $query->join('localities', 'localities.id', '=', 'fields.locality_id');

    if ($this->searchText) {
      $query->where('fields.code', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('fields.*', 'farms.code as cFarm', 'farms.name as nFarm', 'localities.code as cLocality', 'localities.name as nLocality');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.field.field-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->farm = null;
    $this->locality = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->farm) {
        $query->where('fields.farm_id', $this->farm);
      }

      if ($this->locality) {
        $query->where('fields.locality_id', $this->locality);
      }
    }
  }
}
