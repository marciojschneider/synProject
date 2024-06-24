<?php

namespace App\Livewire\Sys\User;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\User;

class UserList extends Component {
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
    $query = User::query();

    $query->select('users.id', 'users.name', 'users.email', 'users.situation')
      ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->groupBy('users.id', 'users.name', 'users.email', 'users.situation')
      ->orderBy('situation', 'desc')
      ->get();

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
      $query->orWhere('email', 'like', '%' . $this->searchText . '%');
      $query->where('user_profiles.client_id', $user->in_client);
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.user.user-list', $data);
  }
}
