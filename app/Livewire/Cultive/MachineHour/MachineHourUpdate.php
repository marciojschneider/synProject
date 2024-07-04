<?php

namespace App\Livewire\Cultive\MachineHour;

use App\Models\MachineHour;
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

class MachineHourUpdate extends Component {
  public $id;
  public $machine_hour;

  // 1° Row
  public $fields = [];
  public $field;
  public $organization;
  public $harvest;
  public $section;
  public $culture;

  // 2° Row
  public $operators = [];
  public $operator;
  public $processes = [];
  public $process;
  public $planting_methods = [];
  public $planting_method;
  public $varieties = [];
  public $variety;

  //Operator
  public $stop_reason;
  public $showStopDetail = false;
  public $showStopDiesel = false;

  //HourMeter
  public $hourmeter_start;
  public $hourmeter_end;
  public $hourmeter_quantity;

  public $hourmeter_rotor_start;
  public $hourmeter_rotor_end;
  public $hourmeter_rotor_quantity;

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
    $this->field = $this->machine_hour->field_id;
    $harvestConfiguration = HarvestConfiguration::where('field_id', $this->field)->first();

    $this->organization = Organization::where('id', $harvestConfiguration->organization_id)->first();
    $this->harvest = Harvest::where('id', $harvestConfiguration->harvest_id)->first();
    $this->section = Section::where('id', $harvestConfiguration->section_id)->first();
    $this->culture = Culture::where('id', $harvestConfiguration->culture_id)->first();
    $this->operator = $this->machine_hour->user_id;
    $this->process = $this->machine_hour->process_id;
    $this->planting_method = $this->machine_hour->planting_method_id;
    $this->variety = $this->machine_hour->variety_id;
    $this->stop_reason = $this->machine_hour->stop_reason;

    $this->hourmeter_start = number_format(floatval($this->machine_hour->hourmeter_start), 2, ',', '.');
    $this->hourmeter_end = number_format(floatval($this->machine_hour->hourmeter_end), 2, ',', '.');
    $this->hourmeter_quantity = number_format(floatval($this->machine_hour->hourmeter_quantity), 2, ',', '.');
    $this->hourmeter_rotor_start = number_format(floatval($this->machine_hour->hourmeter_rotor_start), 2, ',', '.');
    $this->hourmeter_rotor_end = number_format(floatval($this->machine_hour->hourmeter_rotor_end), 2, ',', '.');
    $this->hourmeter_rotor_quantity = number_format(floatval($this->machine_hour->hourmeter_rotor_quantity), 2, ',', '.');

    if ($this->stop_reason) {
      $this->showStopDetail = true;

      if ($this->stop_reason == 3) {
        $this->showStopDiesel = true;
      }
    }
  }

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
}
