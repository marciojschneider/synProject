<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Harvest;

class HarvestList extends Component {
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
    $query = Harvest::query();

    $query->orderBy('situation', 'DESC');

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.harvest-list', $data);
  }
}
