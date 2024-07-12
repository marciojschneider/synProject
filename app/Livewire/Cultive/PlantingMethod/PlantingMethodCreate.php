<?php

namespace App\Livewire\Cultive\PlantingMethod;

use Livewire\Component;
// Models
use App\Models\PlantingMethod;

class PlantingMethodCreate extends Component {
  // 1° Row
  public $code, $name, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $planting_method = new PlantingMethod();
    $planting_method->code = mb_strtoupper($this->code, 'UTF-8');
    $planting_method->name = mb_strtoupper($this->name, 'UTF-8');
    $planting_method->situation = $this->situation;
    $planting_method->creation_user = $user->id;
    $planting_method->client_id = $user->in_client;
    $planting_method->save();

    return redirect()->route('cultive-methods');
  }
}
