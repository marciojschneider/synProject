<?php

namespace App\Livewire\Sys\Security\UserProfile;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\UserProfile;
use App\Models\Profile;

class UserProfileList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;

  public $profiles = [];
  #[Session] public $profile = null;

  public function mount() {
    $user = auth()->user();
    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();

    $query = UserProfile::query();

    $query->join('users', 'users.id', '=', 'user_profiles.user_id');
    $query->join('profiles', 'profiles.id', '=', 'user_profiles.profile_id');
    $query->where('user_profiles.client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('users.name', 'like', '%' . $this->searchText . '%');
    }

    if ($this->profile) {
      $query->where('user_profiles.profile_id', $this->profile);
    }

    $query->select('user_profiles.*', 'users.name as uName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);
    return view('livewire.sys.security.user-profile.user-profile-list', $data);
  }
}
