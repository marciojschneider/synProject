<?php

namespace App\Livewire\Cultive\Process;

use App\Models\Process;
use Livewire\Component;

class ProcessUpdate extends Component {
  // Register
  public $id, $process;
  // 1° Row
  public $code, $name, $type, $situation;

  public function mount() {
    $user = auth()->user();
    $this->process = Process::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->process) {
      return redirect()->route('cultive-processes');
    }

    $this->code = $this->process->code;
    $this->name = $this->process->name;
    $this->type = $this->process->type;
    $this->situation = $this->process->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->process->code = mb_strtoupper($this->code, 'UTF-8');
    $this->process->name = mb_strtoupper($this->name, 'UTF-8');
    $this->process->type = $this->type;
    $this->process->situation = $this->situation;
    $this->process->save();

    return redirect()->route('cultive-processes');
  }
}
