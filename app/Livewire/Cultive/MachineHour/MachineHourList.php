<?php

namespace App\Livewire\Cultive\MachineHour;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\MachineHour;

class MachineHourList extends Component {
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
    $query = MachineHour::query();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.cultive.machine-hour.machine-hour-list', $data);
  }
}
