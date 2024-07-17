<?php

namespace App\Livewire\Structure\Locality;

use Livewire\Component;
// Models
use App\Models\Locality;

class LocalityCreate extends Component {
  // 1° Row
  public $code, $name, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $locality = new Locality();

    $locality->code = mb_strtoupper($this->code, 'UTF-8');
    $locality->name = mb_strtoupper($this->name, 'UTF-8');
    $locality->situation = $this->situation;
    $locality->creation_user = $user->id;
    $locality->client_id = $user->in_client;
    $locality->save();

    return redirect()->route('structure-localities');
  }
}
