<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

// Models
use App\Models\profilePermission;
use App\Models\Sidebar;
use App\Models\Profile;

class ProfilePermissionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $searchText;
  public $pPage = 10;

  public $screens = [];
  #[Session] public $screen = null;
  // public $modules = [];
  // #[Session] public $module = null;
  public $profiles = [];
  #[Session] public $profile = null;

  public function mount() {
    $user = auth()->user();

    // $this->modules = Sidebar::where('icon', '!=', null)
    //   ->where('name', '!=', 'Inicio')
    //   ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
    //   ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  // public function updatedModule() {
  //   $this->screens = Sidebar::where('icon', null)
  //     ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
  //     ->where('affiliate_id', $this->module)
  //     ->get();
  // }

  public function render() {
    $user = auth()->user();
    $query = profilePermission::query();

    $query->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id');
    $query->join('profiles', 'profiles.id', '=', 'profile_permissions.profile_id');
    $query->where('profiles.client_id', $user->in_client);
    $query->where('sidebars.icon', null);

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
    }

    if ($this->profile) {
      $query->where('profile_id', $this->profile);
    }

    if ($this->screen) {
      $query->where('sidebar_id', $this->screen);
    }

    $query->select('profile_permissions.*', 'sidebars.name as sName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.security.profile-permission.profile-permission-list', $data);
  }
}
