<?php

namespace App\Livewire\Structure\Farm;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Farm;

class FarmList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;
  #[Session] public $situation = null;
  #[Session] public $property = null;

  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();
    $query = Farm::query();

    $query->where('client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
    }

    if ($this->situation) {
      $query->where('situation', $this->situation);
    }
    if ($this->property) {
      $query->where('property', $this->property);
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.farm.farm-list', $data);
  }
}
