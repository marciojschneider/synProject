<?php

namespace App\Livewire\Structure\Farm;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

// Models
use App\Models\Farm;
use App\Models\ProfilePermission;

class FarmList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  #[Session] public $searchText;
  public $pPage = 10;
  #[Session] public $situation = null;
  #[Session] public $property = null;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['situation' => $this->situation, 'property' => $this->property]);

    $user = auth()->user();
    $query = Farm::query();

    $query->where('client_id', $user->in_client);

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
    }

    $this->addAdvancedFilters($query);

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.structure.farm.farm-list', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->situation = null;
    $this->property = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query) {
    if ($this->advanced_filters) {
      if ($this->situation) {
        $query->where('situation', $this->situation);
      }
      if ($this->property) {
        $query->where('property', $this->property);
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
    Farm::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-farms');
  }
}
