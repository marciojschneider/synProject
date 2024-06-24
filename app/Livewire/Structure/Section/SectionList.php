<?php

namespace App\Livewire\Structure\Section;

use App\Models\Organization;
use App\Models\Section;
use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

class SectionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;
  public $orgs = [];
  #[Session] public $org = null;

  public function mount() {
    $user = auth()->user();

    $this->orgs = Organization::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();
    $query = Section::query();

    $query->join('organizations', 'organizations.id', '=', 'sections.organization_id');

    $query->where('organizations.client_id', $user->in_client);

    if ($this->org) {
      $query->where('sections.organization_id', $this->org);
    }

    if ($this->searchText) {
      $query->where('sections.name', 'like', '%' . $this->searchText . '%');
    }

    $query->select('sections.*', 'organizations.code as cOrg', 'organizations.name as nOrg');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.section.section-list', $data);
  }
}
