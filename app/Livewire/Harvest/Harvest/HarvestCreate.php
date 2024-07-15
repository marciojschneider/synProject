<?php

namespace App\Livewire\Harvest\Harvest;

use Livewire\Component;
// Models
use App\Models\Harvest;

class HarvestCreate extends Component {
  // 1° Row
  public $code, $name, $price_table, $initial_dt, $ending_dt, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'price_table' => 'required',
    'initial_dt' => 'required',
    'ending_dt' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $harvest = new Harvest();
    $harvest->code = mb_strtoupper($this->code, 'UTF-8');
    $harvest->name = mb_strtoupper($this->name, 'UTF-8');
    $harvest->price_table = $this->price_table;
    $harvest->initial_dt = $this->initial_dt;
    $harvest->ending_dt = $this->ending_dt;
    $harvest->situation = $this->situation;
    $harvest->creation_user = $user->id;
    $harvest->client_id = $user->in_client;
    $harvest->save();

    return redirect()->route('harv-harvests');
  }
}
