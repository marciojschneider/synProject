<?php

namespace App\Livewire\Cultive\Variety;

use Livewire\Component;

// Models
use App\Models\Group;
use App\Models\Culture;
use App\Models\Variety;

class VarietyCreate extends Component {
  // 1° Row
  public $code, $name, $cultures = [], $culture, $groups = [], $group, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->cultures = Culture::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->groups = Group::where('client_id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'culture' => 'required',
    'group' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $variety = new Variety();
    $variety->code = mb_strtoupper($this->code, 'UTF-8');
    $variety->name = mb_strtoupper($this->name, 'UTF-8');
    $variety->culture_id = $this->culture;
    $variety->group_id = $this->group;
    $variety->situation = $this->situation;
    $variety->creation_user = $user->id;
    $variety->client_id = $user->in_client;
    $variety->save();

    return redirect()->route('cultive-varieties');
  }
}
