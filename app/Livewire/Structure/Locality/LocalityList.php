<?php

namespace App\Livewire\Structure\Locality;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Locality;

class LocalityList extends Component {
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
    $query = Locality::query();

    $query->where('client_id', $user->in_client);

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.locality.locality-list', $data);
  }
}
