<?php

namespace App\Livewire\Harvest\Harvest;

use Livewire\Component;
// Models
use App\Models\Harvest;

class HarvestUpdate extends Component {
  // Register
  public $id, $harvest;

  // 1° Row
  public $code, $name, $price_table, $initial_dt, $ending_dt, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->harvest = Harvest::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->harvest) {
      return redirect()->route('harv-harvests');
    }
    // 1° Row
    $this->code = $this->harvest->code;
    $this->name = $this->harvest->name;
    $this->price_table = $this->harvest->price_table;
    $this->initial_dt = date('Y-m-d', strtotime($this->harvest->initial_dt));
    $this->ending_dt = date('Y-m-d', strtotime($this->harvest->ending_dt));
    $this->situation = $this->harvest->situation;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['price_table' => $this->price_table, 'situation' => $this->situation]);
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'price_table' => 'required',
    'initial_dt' => 'required',
    'ending_dt' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->harvest->code = mb_strtoupper($this->code, 'UTF-8');
    $this->harvest->name = mb_strtoupper($this->name, 'UTF-8');
    $this->harvest->price_table = $this->price_table;
    $this->harvest->initial_dt = $this->initial_dt;
    $this->harvest->ending_dt = $this->ending_dt;
    $this->harvest->situation = $this->situation;
    $this->harvest->save();

    return redirect()->route('harv-harvests');
  }
}
