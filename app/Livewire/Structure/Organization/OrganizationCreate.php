<?php

namespace App\Livewire\Structure\Organization;

use Livewire\Component;
// Models
use App\Models\Organization;

class OrganizationCreate extends Component {
  // 1° Row
  public $code, $external_code, $name, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'external_code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $organization = new Organization();

    $organization->code = mb_strtoupper($this->code, 'UTF-8');
    $organization->external_code = mb_strtoupper($this->organization, 'UTF-8');
    $organization->name = mb_strtoupper($this->name, 'UTF-8');
    $organization->situation = $this->situation;
    $organization->creation_user = $user->id;
    $organization->client_id = $user->in_client;
    $organization->save();

    return redirect()->route('structure-organizations');
  }
}
