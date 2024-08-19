<?php

namespace App\Livewire\Structure\Section;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Organization;
use App\Models\Section;
use App\Models\profilePermission;

class SectionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;
  public $organizations = [];
  #[Session] public $organization = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->organizations = Organization::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['organization' => $this->organization]);

    $user = auth()->user();
    $query = Section::query();

    $query->join('organizations', 'organizations.id', '=', 'sections.organization_id');

    $query->where('organizations.client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('sections.code', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('sections.*', 'organizations.code as cOrg', 'organizations.name as nOrg');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.section.section-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->organization = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->organization) {
        $query->where('sections.organization_id', $this->organization);
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
