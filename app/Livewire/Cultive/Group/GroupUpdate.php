<?php

namespace App\Livewire\Cultive\Group;

use Livewire\Component;
// Models
use App\Models\Group;

class GroupUpdate extends Component {
  // Register
  public $id, $group;

  // 1° Row
  public $code, $name, $situation;

  public function mount() {
    $user = auth()->user();
    $this->group = Group::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->group) {
      return redirect()->route('cultive-groups');
    }

    $this->code = $this->group->code;
    $this->name = $this->group->name;
    $this->situation = $this->group->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->group->code = mb_strtoupper($this->code, 'UTF-8');
    $this->group->name = mb_strtoupper($this->name, 'UTF-8');
    $this->group->situation = $this->situation;
    $this->group->save();

    return redirect()->route('cultive-groups');
  }
}
