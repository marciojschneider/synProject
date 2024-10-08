<?php

namespace App\Livewire\Sys\Security\ClosureModule;

use Livewire\Component;

//Models
use App\Models\Sidebar;
use App\Models\ClosureModule;

class ClosureModuleUpdate extends Component {
  // Register
  public $id, $closure_module;
  // 1° Row
  public $modules = [], $module, $screens = [], $screen, $dt_closure, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->closure_module = closureModule::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->closure_module) {
      return redirect()->route('sys-sec-closures');
    }
    // Selects
    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    // 1° Row
    $affiliate = Sidebar::where('id', $this->closure_module->sidebar_id)->first();
    $module = Sidebar::where('id', $affiliate->affiliate_id)->first();
    $this->module = $module->id;

    // Select Screen with module
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();

    $this->screen = $this->closure_module->sidebar_id;
    $this->dt_closure = $this->closure_module->dt_closure;
    $this->situation = $this->closure_module->situation;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['screen' => $this->screen, 'module' => $this->module, 'situation' => $this->situation]);
  }

  protected $rules = [
    'module' => 'required',
    'screen' => 'required',
    'dt_closure' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $verifyUniqueClosure = closureModule::where('sidebar_id', $this->screen)->where('client_id', $user->in_client)->where('id', '!=', $this->id)->first();
    if ($verifyUniqueClosure) {
      return redirect()->route('sys-sec-closures');
    }

    $this->closure_module->sidebar_id = $this->screen;
    $this->closure_module->dt_closure = $this->dt_closure;
    $this->closure_module->situation = $this->situation;
    $this->closure_module->save();

    return redirect()->route('sys-sec-closures');
  }

  // UPDATED Functions
  public function updatedModule() {
    $this->screen = null;

    if ($this->module) {
      $this->screens = Sidebar::where('icon', null)
        ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
        ->where('affiliate_id', $this->module)
        ->get();
    }

    // Dispara para tela a chamada necessária para atualizar o selectpicker.
    $this->dispatch('screens', $this->screens);
  }
}
