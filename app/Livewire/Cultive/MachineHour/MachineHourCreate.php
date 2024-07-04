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

class MachineHourCreate extends Component {
  public $fields = [];
  public $field = null;

  public $operators = [];
  public $operator = null;

  public $processes = [];
  public $process = null;

  public $planting_methods = [];
  public $planting_method = null;

  public $varieties = [];
  public $variety = null;

  public $organization;

  public $harvest;

  public $section;

  public $culture;

  public $stop_reason;

  public $showStopDetail = false;
  public $showStopDiesel = false;

  public $hourmeter_start;
  public $hourmeter_end;
  public $hourmeter_quantity;

  public $hourmeter_rotor_start;
  public $hourmeter_rotor_end;
  public $hourmeter_rotor_quantity;

  public function mount() {
    $user = auth()->user();

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
