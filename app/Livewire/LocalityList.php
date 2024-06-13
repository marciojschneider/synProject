<?php

namespace App\Livewire;

use App\Models\Locality;
use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;


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
    $query = Locality::query();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.locality-list', $data);
  }
}
