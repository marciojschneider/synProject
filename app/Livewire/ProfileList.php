<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Profile;

class ProfileList extends Component {
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
    $query = Profile::query();

    $query->join('clients', 'clients.id', '=', 'profiles.client_id');

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
      $query->orWhere('description', 'like', '%' . $this->searchText . '%');
    }

    $query->select('profiles.*', 'clients.name as cName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.profile-list', $data);
  }
}
