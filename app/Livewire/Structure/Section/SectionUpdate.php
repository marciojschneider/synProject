<?php

namespace App\Livewire\Structure\Section;

use App\Models\Organization;
use App\Models\Section;
use Livewire\Component;

class SectionUpdate extends Component {
  // Register
  public $id, $section;

  // 1° Row
  public $code, $name, $organizations = [], $organization, $responsible, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->section = Section::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->section) {
      return redirect()->route('structure-sections');
    }
    // Selects
    $this->organizations = Organization::where('client_id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->code = $this->section->code;
    $this->name = $this->section->name;
    $this->organization = $this->section->organization_id;
    $this->responsible = $this->section->responsible;
    $this->situation = $this->section->situation;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['organization' => $this->organization, 'responsible' => $this->responsible, 'situation' => $this->situation]);
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'organization' => 'required',
    'responsible' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->section->code = mb_strtoupper($this->code, 'UTF-8');
    $this->section->name = mb_strtoupper($this->name, 'UTF-8');
    $this->section->organization_id = $this->organization;
    $this->section->responsible = $this->responsible;
    $this->section->situation = $this->situation;
    $this->section->save();

    return redirect()->route('structure-sections');
  }
}
