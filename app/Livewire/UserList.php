<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component {
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
    $query = User::query();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.user-list', $data);
  }
}
