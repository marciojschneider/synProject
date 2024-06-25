<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;

//Models
use App\Models\Sidebar;
use App\Models\ClosureModule;

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
      ->select('closure_modules.*', 'sidebars.name as sName')
      ->get();

    if ($this->searchText) {
      $query->where('sidebars.name', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.security.closure-module.closure-module-list', $data);
  }
}
