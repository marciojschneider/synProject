<?php

namespace App\Livewire\Structure\Section;

use App\Models\Organization;
use Livewire\Component;
// Models
use App\Models\Section;

class SectionCreate extends Component {
  // Selects
  public $organizations;
  // 1° Row
  public $code, $name, $organization, $responsible, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->organizations = Organization::where('client_id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'organization' => 'required',
    'responsible' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $section = new Section();

    $section->code = mb_strtoupper($this->code, 'UTF-8');
    $section->name = mb_strtoupper($this->name, 'UTF-8');
    $section->organization_id = $this->organization;
    $section->responsible = $this->responsible;
    $section->situation = $this->situation;
    $section->creation_user = $user->id;
    $section->client_id = $user->in_client;
    $section->save();

    return redirect()->route('structure-sections');
  }
}
