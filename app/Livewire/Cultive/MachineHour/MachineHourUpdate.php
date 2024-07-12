<?php

namespace App\Livewire\Cultive\MachineHour;

use Livewire\Component;
// Models
use App\Models\Field;
use App\Models\Culture;
use App\Models\Harvest;
use App\Models\HarvestConfiguration;
use App\Models\Organization;
use App\Models\PlantingMethod;
use App\Models\Process;
use App\Models\Section;
use App\Models\User;
use App\Models\Variety;
use App\Models\MachineHour;

class MachineHourUpdate extends Component {
  // Register
  public $id, $machine_hour;

  // 1° Row
  public $report, $fields = [], $field, $organization, $harvest, $section, $culture;
  // 2° Row
  public $transaction_type, $transaction_dt, $operators = [], $operator, $processes = [], $process, $planting_methods = [], $planting_method, $varieties = [], $variety;
  // 3° Row
  public $equipament, $implement, $hourmeter_start, $hourmeter_end, $hourmeter_quantity;
  // 4° Row
  public $box_quantity, $hourmeter_rotor_start, $hourmeter_rotor_end, $hourmeter_rotor_quantity;
  // 5° Row
  public $operator_start, $operator_end, $stop_reason;

  // Conditionals
  public $showStopDetail = false, $description, $stop_hour, $showStopDiesel = false, $hourmeter_diesel, $quantity_diesel;

  public function mount() {
    $user = auth()->user();

    // Selects
    $this->fields = Field::where('fields.situation', 1)
      ->where('fields.client_id', $user->in_client)
      ->join('harvest_configurations', 'harvest_configurations.field_id', '=', 'fields.id')
      ->join('harvests', 'harvests.id', '=', 'harvest_configurations.harvest_id')
      ->select('fields.id', 'fields.code', 'fields.name')
      ->groupBy('fields.id', 'fields.code', 'fields.name')
      ->get();

    $this->operators = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $this->processes = Process::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->planting_methods = PlantingMethod::where('client_id', $user->in_client)->where('situation', 1)->get();
    $this->varieties = Variety::where('client_id', $user->in_client)->where('situation', 1)->get();

    // Values
    $this->machine_hour = MachineHour::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->machine_hour) {
      return redirect()->route('cultive-machine-hours');
    }
    // 1° Row
    $this->report = $this->machine_hour->report;
    $this->field = $this->machine_hour->field_id;
    $harvestConfiguration = HarvestConfiguration::where('field_id', $this->machine_hour->field_id)->first();
    $this->organization = Organization::where('id', $harvestConfiguration->organization_id)->first();
    $this->harvest = Harvest::where('id', $harvestConfiguration->harvest_id)->first();
    $this->section = Section::where('id', $harvestConfiguration->section_id)->first();
    $this->culture = Culture::where('id', $harvestConfiguration->culture_id)->first();
    // 2° Row
    $this->transaction_type = $this->machine_hour->transaction_type;
    $this->transaction_dt = $this->machine_hour->transaction_dt;
    $this->operator = $this->machine_hour->user_id;
    $this->process = $this->machine_hour->process_id;
    $this->planting_method = $this->machine_hour->planting_method_id;
    $this->variety = $this->machine_hour->variety_id;
    // 3° Row
    $this->equipament = $this->machine_hour->equipament_id;
    $this->implement = $this->machine_hour->implement_id;
    $this->hourmeter_start = number_format(floatval($this->machine_hour->hourmeter_start), 2, ',', '.');
    $this->hourmeter_end = number_format(floatval($this->machine_hour->hourmeter_end), 2, ',', '.');
    $this->hourmeter_quantity = number_format(floatval($this->machine_hour->hourmeter_quantity), 2, ',', '.');
    // 4° Row
    $this->box_quantity = $this->machine_hour->box_quantity ? number_format(floatval($this->machine_hour->box_quantity), 2, ',', '.') : null;
    $this->hourmeter_rotor_start = $this->machine_hour->hourmeter_rotor_start ? number_format(floatval($this->machine_hour->hourmeter_rotor_start), 2, ',', '.') : null;
    $this->hourmeter_rotor_end = $this->machine_hour->hourmeter_rotor_end ? number_format(floatval($this->machine_hour->hourmeter_rotor_end), 2, ',', '.') : null;
    $this->hourmeter_rotor_quantity = $this->machine_hour->hourmeter_rotor_quantity ? number_format(floatval($this->machine_hour->hourmeter_rotor_quantity), 2, ',', '.') : null;
    // 5° Row
    $this->operator_start = $this->machine_hour->operator_start;
    $this->operator_end = $this->machine_hour->operator_end;
    $this->stop_reason = $this->machine_hour->stop_reason;

    if ($this->stop_reason) {
      $this->showStopDetail = true;
      $this->description = $this->machine_hour->stop_description;
      $this->stop_hour = $this->machine_hour->stop_hour;

      if ($this->stop_reason == 3) {
        $this->showStopDiesel = true;
        $this->hourmeter_diesel = number_format(floatval($this->machine_hour->hourmeter_diesel), 2, ',', '.');
        $this->quantity_diesel = number_format(floatval($this->machine_hour->quantity_diesel), 2, ',', '.');
      }
    }
  }

  protected $rules = [
    'report' => 'required',
    'field' => 'required',
    'organization' => 'required',
    'harvest' => 'required',
    'section' => 'required',
    'culture' => 'required',
    'transaction_type' => 'required',
    'transaction_dt' => 'required',
    'operator' => 'required',
    'process' => 'required',
    'planting_method' => 'required',
    'variety' => 'required',
    'equipament' => 'required',
    'hourmeter_start' => 'required',
    'hourmeter_end' => 'required',
    'hourmeter_quantity' => 'required'
  ];

  public function submit() {
    $this->validate();

    $this->machine_hour->report = mb_strtoupper($this->report, 'UTF-8');
    $this->machine_hour->field_id = $this->field;
    $this->machine_hour->organization_id = $this->organization['id'];
    $this->machine_hour->harvest_id = $this->harvest['id'];
    $this->machine_hour->section_id = $this->section['id'];
    $this->machine_hour->culture_id = $this->culture['id'];
    $this->machine_hour->transaction_type = $this->transaction_type;
    $this->machine_hour->transaction_dt = $this->transaction_dt;
    $this->machine_hour->variety_id = $this->variety;
    $this->machine_hour->planting_method_id = $this->planting_method;
    $this->machine_hour->process_id = $this->process;
    $this->machine_hour->equipament_id = $this->equipament;
    $this->machine_hour->implement_id = $this->implement;
    $this->machine_hour->user_id = $this->operator;
    $this->machine_hour->hourmeter_start = $this->formatNumberValue($this->hourmeter_start);
    $this->machine_hour->hourmeter_end = $this->formatNumberValue($this->hourmeter_end);
    $this->machine_hour->hourmeter_quantity = $this->formatNumberValue($this->hourmeter_quantity);
    if ($this->stop_reason) {
      $this->machine_hour->stop_reason = $this->stop_reason;
      $this->machine_hour->stop_description = $this->description;
      $this->machine_hour->stop_hour = $this->stop_hour;
    }
    if ($this->stop_reason == 3) {
      $this->machine_hour->quantity_diesel = $this->formatNumberValue($this->quantity_diesel);
      $this->machine_hour->hourmeter_diesel = $this->formatNumberValue($this->hourmeter_diesel);
    }
    $this->machine_hour->operator_start = $this->operator_start;
    $this->machine_hour->operator_end = $this->operator_end;
    $this->machine_hour->quantity_box = $this->box_quantity ? $this->formatNumberValue($this->box_quantity) : null;
    $this->machine_hour->hourmeter_rotor_start = $this->hourmeter_rotor_start ? $this->formatNumberValue($this->hourmeter_rotor_start) : null;
    $this->machine_hour->hourmeter_rotor_end = $this->hourmeter_rotor_end ? $this->formatNumberValue($this->hourmeter_rotor_end) : null;
    $this->machine_hour->hourmeter_rotor_quantity = $this->hourmeter_rotor_quantity ? $this->formatNumberValue($this->hourmeter_rotor_quantity) : null;
    $this->machine_hour->save();

    return redirect()->route('cultive-machine-hours');
  }

  // UPDATED Functions
  public function updatedField() {
    if (!$this->field) {
      $this->organization = null;
      $this->harvest = null;
      $this->section = null;
      $this->culture = null;

      return;
    }

    $harvestConfiguration = HarvestConfiguration::where('field_id', $this->field)->first();

    $this->organization = Organization::where('id', $harvestConfiguration->organization_id)->first();
    $this->harvest = Harvest::where('id', $harvestConfiguration->harvest_id)->first();
    $this->section = Section::where('id', $harvestConfiguration->section_id)->first();
    $this->culture = Culture::where('id', $harvestConfiguration->culture_id)->first();
  }

  public function updatedStopReason() {
    if ($this->stop_reason) {
      $this->showStopDetail = true;
      $this->showStopDiesel = false;

      if ($this->stop_reason == 3) {
        $this->showStopDiesel = true;
      }

      return;
    }

    $this->showStopDetail = false;
  }

  public function updatedHourMeterEnd() {
    $formatStart = implode('', explode('.', $this->hourmeter_start));
    $formatEnd = implode('', explode('.', $this->hourmeter_end));

    $this->hourmeter_quantity =
      number_format(floatval(implode('.', explode(',', $formatEnd))), 2, '.', '') - number_format(floatval(implode('.', explode(',', $formatStart))), 2, '.', '');

    $this->hourmeter_quantity = number_format(floatval(implode('.', explode(',', $this->hourmeter_quantity))), 2, ',', '.');
  }

  public function updatedHourMeterRotorEnd() {
    $formatStart = implode('', explode('.', $this->hourmeter_rotor_start));
    $formatEnd = implode('', explode('.', $this->hourmeter_rotor_end));

    $this->hourmeter_rotor_quantity = number_format(floatval(implode('.', explode(',', $formatEnd))), 2, '.', '') - number_format(floatval(implode('.', explode(',', $formatStart))), 2, '.', '');

    $this->hourmeter_rotor_quantity = number_format(floatval(implode('.', explode(',', $this->hourmeter_rotor_quantity))), 2, ',', '.');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
