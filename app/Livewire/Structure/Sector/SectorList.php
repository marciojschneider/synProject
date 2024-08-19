<?php

namespace App\Livewire\Structure\Sector;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Sector;
use App\Models\Farm;
use App\Models\profilePermission;

class SectorList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;
  public $farms = [];
  #[Session] public $farm = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->farms = Farm::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['farm' => $this->farm]);

    $user = auth()->user();
    $query = Sector::query();

    $query->join('farms', 'farms.id', '=', 'sectors.farm_id');

    $query->where('sectors.client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('sectors.name', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('sectors.*', 'farms.code as cFarm', 'farms.name as nFarm');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.sector.sector-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->farm = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->farm) {
        $query->where('farms.id', $this->farm);
      }
    }
  }

  public function removeRegister(string $rName, int $id) {
    $user = auth()->user();

    $sqlPermission = profilePermission::join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->where('profile_permissions.profile_id', $user->in_profile)
      ->where('sidebars.url', 'like', '%' . $rName . '%')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('profile_permissions.delete', 1)
      ->get();

    if (!isset($sqlPermission[0]) || count($sqlPermission) === 0) {
      $this->dispatch('swal', [
        'title' => 'Sem Permissão',
        'icon' => 'error',
      ]);

      return;
    }

    $this->dispatch('swal', [
      'id' => $id
    ]);
  }
}
