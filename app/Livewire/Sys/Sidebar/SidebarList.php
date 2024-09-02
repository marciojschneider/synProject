<?php

namespace App\Livewire\Sys\Sidebar;

use App\Models\Client;
use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

// Models
use App\Models\Sidebar;
use App\Models\ProfilePermission;
use App\Models\UserProfile;

class SidebarList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;

  public $modules = [];
  #[Session] public $module = null;
  public $clients = [];
  #[Session] public $client = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->get();

    $this->clients = Client::where('situation', 1)
      ->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $cName = [];
    $query = Sidebar::query();

    if ($this->searchText) {
      $query->where('sidebars.name', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $query->get();

    $data['rows'] = $query->paginate($this->pPage);

    for ($i = 0; $i < count($data['rows']); $i++) {
      $clients = explode(',', $data['rows'][$i]['client_id']);
      foreach ($clients as $client) {
        $qCName = Client::where('id', $client)->select('name')->get();

        if (!$cName) {
          $cName[] = $qCName[0]['name'];
        } else {
          $cName[] = $qCName[0]['name'];
        }

        $data['rows'][$i]['cName'] = $cName;
      }
      $cName = [];

      $affiliate = $data['rows'][$i]['affiliate_id'];
      if ($affiliate !== 0) {
        $qAName = Sidebar::where('id', $affiliate)->select('name')->get();
        $aName = $qAName[0]['name'];

        $data['rows'][$i]['aColor'] = "secondary";
        $data['rows'][$i]['aName'] = $aName;
      } else {
        $data['rows'][$i]['aColor'] = "primary";
        $data['rows'][$i]['aName'] = "Principal";
      }
    }

    return view('livewire.sys.sidebar.sidebar-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->module = null;
    $this->client = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->module !== null) {
        $query->where('affiliate_id', $this->module);
      }

      if ($this->client) {
        $query->where('client_id', 'REGEXP', '[[:<:]]' . $this->client . '[[:>:]]');
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
    Sidebar::where('id', $id)->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')->delete();

    return redirect()->route('sys-sidebars');
  }
}
