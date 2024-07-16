<?php

namespace App\Livewire\Structure\Field;

use Livewire\Component;
// Models
use App\Models\Farm;
use App\Models\Field;
use App\Models\Locality;

class FieldCreate extends Component {
  // Selects
  public $farms, $localities;
  // 1° Row
  public $code, $name, $farm, $locality;
  // 2° Row
  public $total_area, $productive_area, $property_registration, $local_group, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->farms = Farm::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->localities = Locality::where('client_id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
    'farm' => 'required',
    'locality' => 'required',
    'total_area' => 'required',
    'productive_area' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $field = new Field();

    $field->code = mb_strtoupper($this->code, 'UTF-8');
    $field->name = mb_strtoupper($this->name, 'UTF-8');
    $field->farm_id = $this->farm;
    $field->locality_id = $this->locality;
    $field->total_area = $this->formatNumberValue($this->total_area);
    $field->productive_area = $this->formatNumberValue($this->productive_area);
    $field->property_registration = mb_strtoupper($this->property_registration, 'UTF-8');
    $field->local_group = mb_strtoupper($this->local_group, 'UTF-8');
    $field->situation = $this->situation;
    $field->creation_user = $user->id;
    $field->client_id = $user->in_client;
    $field->save();

    return redirect()->route('structure-fields');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
