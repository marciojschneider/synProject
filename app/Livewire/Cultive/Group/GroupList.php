<?php

namespace App\Livewire\Cultive\Group;

use Livewire\Component;
// Livewire Adicionais
use Livewire\Attributes\Session;
use Livewire\WithPagination;
// Models
use App\Models\Group;

class GroupList extends Component {
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
    $query = Group::query();

    $query->where('client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
      $query->orWhere('code', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.cultive.group.group-list', $data);
  }

  public function removeRegister(string $rName, int $id) {
    $user = auth()->user();

    $sqlPermission = profilePermission::join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
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
}
