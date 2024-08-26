<?php

namespace App\Livewire\Cultive\Process;

use Livewire\Component;

// Livewire Adicionais
use Livewire\Attributes\Session;
use Livewire\WithPagination;
use Livewire\Attributes\On;

// Models
use App\Models\Process;
use App\Models\ProfilePermission;

class ProcessList extends Component {
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
    $query = Process::query();

    $query->where('client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('code', 'like', '%' . $this->searchText . '%');
      $query->orWhere('name', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.cultive.process.process-list', $data);
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
    Process::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-processes');
  }
}
