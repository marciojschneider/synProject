<?php

namespace App\Livewire\Cultive\Group;

use Livewire\Component;
// Models
use App\Models\Group;

class GroupCreate extends Component {
  // 1° Row
  public $code, $name, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $group = new Group();
    $group->code = mb_strtoupper($this->code, 'UTF-8');
    $group->name = mb_strtoupper($this->name, 'UTF-8');
    $group->situation = $this->situation;
    $group->creation_user = $user->id;
    $group->client_id = $user->in_client;
    $group->save();

    return redirect()->route('cultive-groups');
  }
}
