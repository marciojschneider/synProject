<?php

namespace App\Livewire\Support\Task;

use Livewire\Component;

// Models
use App\Models\Task;
use App\Models\Sidebar;

class TaskUpdate extends Component {
  public $id;
  public $task;
  public $modules = [];
  public $module = null;
  public $screens = [];
  public $screen = null;

  public function mount() {
    $user = auth()->user();
    $this->task = Task::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->task) {
      return redirect()->route('sys-sec-closures');
    }

    // TODO: verificar possibilidade de melhoria de lógica
    $affiliate = Sidebar::where('id', $this->task->sidebar_id)->first();
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
