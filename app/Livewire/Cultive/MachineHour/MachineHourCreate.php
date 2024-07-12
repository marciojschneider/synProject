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

class MachineHourCreate extends Component {
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

    $this->transaction_dt = date('Y-m-d', strtotime(now('America/Sao_Paulo')));

    $this->fields = Field::where('fields.situation', 1)
      ->where('fields.client_id', $user->in_client)
      ->join('harvest_configurations', 'harvest_configurations.field_id', '=', 'fields.id')
      ->where('harvest_configurations.situation', 1)
      ->join('harvests', 'harvests.id', '=', 'harvest_configurations.harvest_id')
      ->where('harvests.situation', 1)
      ->select('fields.*')
      ->get();

    $this->operators = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $this->processes = Process::where('client_id', $user->in_client)->where('situation', 1)->get();

    $this->planting_methods = PlantingMethod::where('client_id', $user->in_client)->where('situation', 1)->get();

    $this->varieties = Variety::where('client_id', $user->in_client)->where('situation', 1)->get();
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
    $user = auth()->user();
    $this->validate();

    $machineHourCreate = new MachineHour();
    $machineHourCreate->report = mb_strtoupper($this->report, 'UTF-8');
    $machineHourCreate->field_id = $this->field;
    $machineHourCreate->organization_id = $this->organization['id'];
    $machineHourCreate->harvest_id = $this->harvest['id'];
    $machineHourCreate->section_id = $this->section['id'];
    $machineHourCreate->culture_id = $this->culture['id'];
    $machineHourCreate->transaction_type = $this->transaction_type;
    $machineHourCreate->transaction_dt = $this->transaction_dt;
    $machineHourCreate->variety_id = $this->variety;
    $machineHourCreate->planting_method_id = $this->planting_method;
    $machineHourCreate->process_id = $this->process;
    $machineHourCreate->equipament_id = $this->equipament;
    $machineHourCreate->implement_id = $this->implement;
    $machineHourCreate->user_id = $this->operator;
    $machineHourCreate->hourmeter_start = $this->formatNumberValue($this->hourmeter_start);
    $machineHourCreate->hourmeter_end = $this->formatNumberValue($this->hourmeter_end);
    $machineHourCreate->hourmeter_quantity = $this->formatNumberValue($this->hourmeter_quantity);
    if ($this->stop_reason) {
      $machineHourCreate->stop_reason = $this->stop_reason;
      $machineHourCreate->stop_description = $this->description;
      $machineHourCreate->stop_hour = $this->stop_hour;
    }
    if ($this->stop_reason == 3) {
      $machineHourCreate->quantity_diesel = $this->formatNumberValue($this->quantity_diesel);
      $machineHourCreate->hourmeter_diesel = $this->formatNumberValue($this->hourmeter_diesel);
    }
    $machineHourCreate->operator_start = $this->operator_start;
    $machineHourCreate->operator_end = $this->operator_end;
    $machineHourCreate->quantity_box = $this->box_quantity ? $this->formatNumberValue($this->box_quantity) : null;
    $machineHourCreate->hourmeter_rotor_start = $this->hourmeter_rotor_start ? $this->formatNumberValue($this->hourmeter_rotor_start) : null;
    $machineHourCreate->hourmeter_rotor_end = $this->hourmeter_rotor_end ? $this->formatNumberValue($this->hourmeter_rotor_end) : null;
    $machineHourCreate->hourmeter_rotor_quantity = $this->hourmeter_rotor_quantity ? $this->formatNumberValue($this->hourmeter_rotor_quantity) : null;
    $machineHourCreate->creation_user = $user->id;
    $machineHourCreate->client_id = $user->in_client;
    $machineHourCreate->save();

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
