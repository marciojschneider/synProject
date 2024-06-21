<?php

namespace App\Livewire\Structure\Section;

use App\Models\Section;
use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

class SectionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  public $searchText;
  public $pPage = 10;
  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }
  public function updated() {
    $this->resetPage();
  }
  public function render() {
    $user = auth()->user();
    $query = Section::query();

    $query->join('organizations', 'organizations.id', '=', 'sections.organization_id');

    $query->where('organizations.client_id', $user->in_client);

    $query->select('sections.*', 'organizations.code as cOrg', 'organizations.name as nOrg');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.section.section-list', $data);
  }
}
