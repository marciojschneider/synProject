<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use Livewire\Component;

//Models
use App\Models\Sidebar;

class ClosureModuleCreate extends Component {
  public $modules = [];
  public $module = null;

  public $screens = [];
  public $screen = null;

  public function mount() {
    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->modules[0]['id'])
      ->get();
  }

  public function updatedModule() {
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();
  }
}
