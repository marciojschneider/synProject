<?php

namespace App\Livewire\Cultive\Process;

use Livewire\Component;
// Models
use App\Models\Process;

class ProcessCreate extends Component {
  // 1° Row
  public $code, $name, $type = 1, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $process = new Process();
    $process->code = mb_strtoupper($this->code, 'UTF-8');
    $process->name = mb_strtoupper($this->name, 'UTF-8');
    $process->type = $this->type;
    $process->situation = $this->situation;
    $process->creation_user = $user->id;
    $process->client_id = $user->in_client;
    $process->save();

    return redirect()->route('cultive-processes');
  }
}
