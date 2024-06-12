<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

// Models
use App\Models\UserProfile;

class UserProfileList extends Component {
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
    $query = UserProfile::query();

    $query->join('users', 'users.id', '=', 'user_profiles.user_id');
    $query->join('profiles', 'profiles.id', '=', 'user_profiles.profile_id');


    $query->select('user_profiles.*', 'users.name as uName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.user-profile-list', $data);
  }
}
