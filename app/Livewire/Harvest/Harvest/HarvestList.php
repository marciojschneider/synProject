<?php

namespace App\Livewire\Harvest\Harvest;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Harvest;

class HarvestList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;

  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();
    $query = Harvest::query();

    $query->orderBy('situation', 'DESC');

    if ($this->searchText) {
      $query->where('code', 'like', '%' . $this->searchText . '%');
      $query->orWhere('name', 'like', '%' . $this->searchText . '%');
    }

    $query->where('client_id', $user->in_client);

    $data['rows'] = $query->paginate($this->pPage);
    return view('livewire.harvest.harvest.harvest-list', $data);
  }
}
