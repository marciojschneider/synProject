<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use Livewire\Component;

//Models
use App\Models\Sidebar;
use App\Models\ClosureModule;

class ClosureModuleUpdate extends Component {
  public $id;
  public $closure_module;
  public $modules = [];
  public $module = null;
  public $screens = [];
  public $screen = null;

  public function mount() {
    $this->closure_module = closureModule::find($this->id);

    // TODO: verificar possibilidade de melhoria de lógica
    $affiliate = Sidebar::where('id', $this->closure_module->sidebar_id)->first();
    $module = Sidebar::where('id', $affiliate->affiliate_id)->first();

    $this->module = $module->id;

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $affiliate->affiliate_id)
      ->get();
  }

  public function updatedModule() {
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();
  }
}
