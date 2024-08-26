<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

//Models
use App\Models\ClosureModule;
use App\Models\ProfilePermission;

class ClosureModuleList extends Component {
  use WithPagination;
  // Declaração de paginationTheme para a utilização da linguagem bootstrap.
  protected $paginationTheme = 'bootstrap';

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
    $query = closureModule::query();

    $query->join('sidebars', 'sidebars.id', '=', 'closure_modules.sidebar_id')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('closure_modules.client_id', $user->in_client)
      ->select('closure_modules.*', 'sidebars.name as sName')
      ->get();

    if ($this->searchText) {
      $query->where('sidebars.name', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.security.closure-module.closure-module-list', $data);
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
    closureModule::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-closures');
  }
}
