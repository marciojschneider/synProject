<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use App\Models\ClosureModule;
use Livewire\Component;
//Models
use App\Models\Sidebar;

class ClosureModuleCreate extends Component {
  // 1° Row
  public $modules = [], $module, $screens = [], $screen, $dt_closure, $situation = 1;

  public function mount() {
    $this->dt_closure = date('Y-m-d', strtotime(now('America/Sao_Paulo')));

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->modules[0]['id'])
      ->get();
  }

  protected $rules = [
    'module' => 'required',
    'screen' => 'required',
    'dt_closure' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $verifyUniqueClosure = closureModule::where('sidebar_id', $this->screen)->where('client_id', $user->in_client)->first();
    if ($verifyUniqueClosure) {
      return redirect()->route('sys-sec-closures');
    }

    $closure_module = new ClosureModule();

    $closure_module->sidebar_id = $this->screen;
    $closure_module->dt_closure = $this->dt_closure;
    $closure_module->situation = $this->situation;
    $closure_module->client_id = $user->in_client;
    $closure_module->creation_user = $user->id;
    $closure_module->save();

    return redirect()->route('sys-sec-closures');
  }

  // UPDATED Functions
  public function updatedModule() {
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();
  }
}
