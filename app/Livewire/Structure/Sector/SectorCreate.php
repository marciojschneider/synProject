<?php

namespace App\Livewire\Structure\Sector;

use Livewire\Component;
// Models
use App\Models\Farm;
use App\Models\Sector;

class SectorCreate extends Component {
  // Selects
  public $farms;
  // 1° Row
  public $code, $name, $farm, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->farms = Farm::where('client_id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'farm' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $sector = new Sector();

    $sector->code = mb_strtoupper($this->code, 'UTF-8');
    $sector->name = mb_strtoupper($this->name, 'UTF-8');
    $sector->farm_id = $this->farm;
    $sector->situation = $this->situation;
    $sector->creation_user = $user->id;
    $sector->client_id = $user->in_client;
    $sector->save();

    return redirect()->route('structure-sectors');
  }
}
