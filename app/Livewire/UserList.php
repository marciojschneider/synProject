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
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.user-list', $data);
  }
}
