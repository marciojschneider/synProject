<?php

namespace App\Livewire\Cultive\PlantingMethod;

use Livewire\Component;
// Models
use App\Models\PlantingMethod;

class PlantingMethodUpdate extends Component {
  // Register
  public $id, $planting_method;

  // 1° Row
  public $code, $name, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->planting_method = PlantingMethod::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->planting_method) {
      return redirect()->route('cultive-methods');
    }

    $this->code = $this->planting_method->code;
    $this->name = $this->planting_method->name;
    $this->situation = $this->planting_method->situation;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['situation' => $this->situation]);
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->planting_method->code = mb_strtoupper($this->code, 'UTF-8');
    $this->planting_method->name = mb_strtoupper($this->name, 'UTF-8');
    $this->planting_method->situation = $this->situation;
    $this->planting_method->save();

    return redirect()->route('cultive-methods');
  }
}
