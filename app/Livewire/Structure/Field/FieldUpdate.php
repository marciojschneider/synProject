<?php

namespace App\Livewire\Structure\Field;

use Livewire\Component;
// Models
use App\Models\Farm;
use App\Models\Field;
use App\Models\Locality;

class FieldUpdate extends Component {
  // Register
  public $id, $field;

  // 1° Row
  public $code, $name, $farms = [], $farm, $localities = [], $locality;
  // 2° Row
  public $total_area, $productive_area, $property_registration, $local_group, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->field = Field::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->field) {
      return redirect()->route('structure-fields');
    }
    // Selects
    $this->farms = Farm::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->localities = Locality::where('client_id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->code = $this->field->code;
    $this->name = $this->field->name;
    $this->farm = $this->field->farm_id;
    $this->locality = $this->field->locality_id;
    // 2° Row
    $this->total_area = number_format(floatval($this->field->total_area), 2, ',', '.');
    $this->productive_area = number_format(floatval($this->field->productive_area), 2, ',', '.');
    $this->property_registration = $this->field->property_registration;
    $this->local_group = $this->field->local_group;
    $this->situation = $this->field->situation;
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
    $this->validate();

    $this->field->code = mb_strtoupper($this->code, 'UTF-8');
    $this->field->name = mb_strtoupper($this->name, 'UTF-8');
    $this->field->farm_id = $this->farm;
    $this->field->locality_id = $this->locality;
    $this->field->total_area = $this->formatNumberValue($this->total_area);
    $this->field->productive_area = $this->formatNumberValue($this->productive_area);
    $this->field->property_registration = mb_strtoupper($this->property_registration, 'UTF-8');
    $this->field->local_group = mb_strtoupper($this->local_group, 'UTF-8');
    $this->field->situation = $this->situation;
    $this->field->save();

    return redirect()->route('structure-fields');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
