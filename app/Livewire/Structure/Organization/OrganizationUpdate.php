<?php

namespace App\Livewire\Structure\Organization;

use Livewire\Component;
// Models
use App\Models\Organization;

class OrganizationUpdate extends Component {
  // Register
  public $id, $organization;
  // 1° Row
  public $code, $external_code, $name, $situation;

  public function mount() {
    $user = auth()->user();
    $this->organization = Organization::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->organization) {
      return redirect()->route('structure-organizations');
    }

    $this->code = $this->organization->code;
    $this->external_code = $this->organization->external_code;
    $this->name = $this->organization->name;
    $this->situation = $this->organization->situation;
  }

  protected $rules = [
    'code' => 'required',
    'external_code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->organization->code = mb_strtoupper($this->code, 'UTF-8');
    $this->organization->external_code = mb_strtoupper($this->organization, 'UTF-8');
    $this->organization->name = mb_strtoupper($this->name, 'UTF-8');
    $this->organization->situation = $this->situation;
    $this->organization->save();

    return redirect()->route('structure-organizations');
  }
}
