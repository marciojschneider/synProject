<?php

namespace App\Livewire\Cultive\Variety;

use Livewire\Component;

// Models
use App\Models\Group;
use App\Models\Culture;
use App\Models\Variety;

class VarietyUpdate extends Component {
  // Register
  public $id, $variety;
  // 1° Row
  public $code, $name, $cultures = [], $culture, $groups = [], $group, $situation;

  public function mount() {
    $user = auth()->user();

    // Selects
    $this->cultures = Culture::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->groups = Group::where('client_id', $user->in_client)->where('situation', 1)->get();

    // Values
    $this->variety = Variety::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->variety) {
      return redirect()->route('cultive-varieties');
    }

    $this->code = $this->variety->code;
    $this->name = $this->variety->name;
    $this->culture = $this->variety->culture_id;
    $this->group = $this->variety->group_id;
    $this->situation = $this->variety->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'culture' => 'required',
    'group' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->variety->code = mb_strtoupper($this->code, 'UTF-8');
    $this->variety->name = mb_strtoupper($this->name, 'UTF-8');
    $this->variety->culture_id = $this->culture;
    $this->variety->group_id = $this->group;
    $this->variety->situation = $this->situation;
    $this->variety->save();

    return redirect()->route('cultive-varieties');
  }
}
