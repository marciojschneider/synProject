<?php

namespace App\Livewire;

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
    $query = Section::query();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.section-list', $data);
  }
}
