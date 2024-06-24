<?php

namespace App\Livewire\Sys\Profile;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\Profile;

class ProfileList extends Component {
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
    $query = Profile::query();

    $query->join('clients', 'clients.id', '=', 'profiles.client_id');

    if ($this->searchText) {
      $query->where('profiles.name', 'like', '%' . $this->searchText . '%');
    }

    $query->where('clients.id', $user->in_client);

    $query->select('profiles.*', 'clients.name as cName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.profile.profile-list', $data);
  }
}
