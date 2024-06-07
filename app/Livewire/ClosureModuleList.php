<?php

namespace App\Livewire;

use App\Models\closureModule;
use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

//Models
use App\Models\Sidebar;

class ClosureModuleList extends Component {
  use WithPagination;
  // Declaração de paginationTheme para a utilização da linguagem bootstrap.
  protected $paginationTheme = 'bootstrap';

  public $searchText;
  public $pPage = 10;
  public $sidebars;
  public $sidebar;

  public function mount() {
    $this->sidebars = Sidebar::where('icon', null)->get();
  }

  public function updated() {
    $this->resetPage();
  }
  public function render() {
    $query = closureModule::query();

    $query->join('sidebars', 'sidebars.id', '=', 'closure_modules.sidebar_id')
      ->select('closure_modules.*', 'sidebars.name as sName')
      ->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.closure-module-list', $data);
  }
}
