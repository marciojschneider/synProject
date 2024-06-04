<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;

// Models
use App\Models\profilePermission;
use App\Models\Sidebar;
use App\Models\Profile;

class profilePermissionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $searchText;
  public $pPage = 10;

  public $modules;
  public $module;
  public $profiles;
  public $profile;

  public function mount() {
    $this->modules = Sidebar::where('icon', null)->get();
    $this->profiles = Profile::all();
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = profilePermission::query();

    $query->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id');
    $query->join('profiles', 'profiles.id', '=', 'profile_permissions.profile_id');

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
      $query->orWhere('description', 'like', '%' . $this->searchText . '%');
    }

    if ($this->profile) {
      $query->where('profile_id', $this->profile);
    }

    if ($this->module) {
      $query->where('sidebar_id', $this->module);
    }

    $query->select('profile_permissions.*', 'sidebars.name as sName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.profile-permission-list', $data);
  }
}
