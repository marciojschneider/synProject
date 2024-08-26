<?php

namespace App\Livewire\Sys\Security\UserProfile;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

// Models
use App\Models\UserProfile;
use App\Models\Profile;
use App\Models\ProfilePermission;

class UserProfileList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;

  public $profiles = [];
  #[Session] public $profile = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();
    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['profile' => $this->profile]);

    $user = auth()->user();

    $query = UserProfile::query();

    $query->join('users', 'users.id', '=', 'user_profiles.user_id');
    $query->join('profiles', 'profiles.id', '=', 'user_profiles.profile_id');
    $query->where('user_profiles.client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('users.name', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('user_profiles.*', 'users.name as uName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);
    return view('livewire.sys.security.user-profile.user-profile-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->profile = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->profile) {
        $query->where('user_profiles.profile_id', $this->profile);
      }
    }
  }

  public function removeRegister(string $rName, int $id) {
    $user = auth()->user();

    $sqlPermission = ProfilePermission::join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->where('profile_permissions.profile_id', $user->in_profile)
      ->where('sidebars.url', 'like', '%' . $rName . '%')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('profile_permissions.delete', 1)
      ->get();

    if (!isset($sqlPermission[0]) || count($sqlPermission) === 0) {
      $this->dispatch('swal', [
        'title' => 'Sem Permissão',
        'icon' => 'error',
      ]);

      return;
    }

    $this->dispatch('swal', [
      'id' => $id
    ]);
  }

  #[On('removeAction')]
  public function removeAction(int $id) {
    $user = auth()->user();
    UserProfile::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-u-ps');
  }
}
