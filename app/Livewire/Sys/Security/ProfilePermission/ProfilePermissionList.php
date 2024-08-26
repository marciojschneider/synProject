<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

// Models
use App\Models\ProfilePermission;
use App\Models\Sidebar;
use App\Models\Profile;

class ProfilePermissionList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  #[Session] public $searchText;
  public $pPage = 10;

  public $screens = [];
  #[Session] public $screen = null;
  public $modules = [];
  #[Session] public $module = null;
  public $profiles = [];
  #[Session] public $profile = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    if ($this->module) {
      $this->screens = Sidebar::where('icon', null)
        ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
        ->where('affiliate_id', $this->module)
        ->get();
    }

    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function updatedModule() {
    $this->screen = null;

    if ($this->module) {
      $this->screens = Sidebar::where('icon', null)
        ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
        ->where('affiliate_id', $this->module)
        ->get();
    }

    // Dispara para tela a chamada necessária para atualizar o selectpicker.
    $this->dispatch('screens', $this->screens);
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['screen' => $this->screen, 'module' => $this->module, 'profile' => $this->profile]);

    $user = auth()->user();
    $query = ProfilePermission::query();

    $query->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id');
    $query->join('profiles', 'profiles.id', '=', 'profile_permissions.profile_id');
    $query->where('profiles.client_id', $user->in_client);
    $query->where('sidebars.icon', null);

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->select('profile_permissions.*', 'sidebars.name as sName', 'profiles.name as pName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.security.profile-permission.profile-permission-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->module = null;
    $this->screen = null;
    $this->profile = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->screen) {
        $query->where('sidebar_id', $this->screen);
      }

      if ($this->profile) {
        $query->where('profile_id', $this->profile);
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
    ProfilePermission::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-permissions');
  }
}
