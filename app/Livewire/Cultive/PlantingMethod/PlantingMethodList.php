<?php

namespace App\Livewire\Cultive\PlantingMethod;

use Livewire\Component;
// Livewire Adicionais
use Livewire\WithPagination;
// Models
use App\Models\PlantingMethod;

class PlantingMethodList extends Component {
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
    $query = PlantingMethod::query();

    $query->where('client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('code', 'like', '%' . $this->searchText . '%');
      $query->orWhere('name', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.cultive.planting-method.planting-method-list', $data);
  }
}
