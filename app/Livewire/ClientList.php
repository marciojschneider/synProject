<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Client;

class ClientList extends Component {
  use WithPagination;
  // Declaração de paginationTheme para a utilização da linguagem bootstrap.
  protected $paginationTheme = 'bootstrap';

  public $searchText;
  public $pPage = 10;


  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = Client::query();

    if ($this->searchText) {
      $query->where('code', 'like', '%' . $this->searchText . '%');
      $query->orWhere('name', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.client-list', $data);
  }
}
