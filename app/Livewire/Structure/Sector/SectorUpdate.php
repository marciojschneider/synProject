<?php

namespace App\Livewire\Structure\Sector;

use Livewire\Component;
// Models
use App\Models\Farm;
use App\Models\Sector;

class SectorUpdate extends Component {
  // Register
  public $id, $sector;

  // 1° Row
  public $code, $name, $farms = [], $farm, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->sector = Sector::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->sector) {
      return redirect()->route('structure-sectors');
    }
    // Selects
    $this->farms = Farm::where('client_id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->code = $this->sector->code;
    $this->name = $this->sector->name;
    $this->farm = $this->sector->farm_id;
    $this->situation = $this->sector->situation;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['farm' => $this->farm, 'situation' => $this->situation]);
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'farm' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->sector->code = mb_strtoupper($this->code, 'UTF-8');
    $this->sector->name = mb_strtoupper($this->name, 'UTF-8');
    $this->sector->farm_id = $this->farm;
    $this->sector->situation = $this->situation;
    $this->sector->save();

    return redirect()->route('structure-sectors');
  }
}
