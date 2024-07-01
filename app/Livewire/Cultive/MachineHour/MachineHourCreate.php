<?php

namespace App\Livewire\Cultive\MachineHour;

use App\Models\Culture;
use App\Models\Harvest;
use App\Models\HarvestConfiguration;
use App\Models\Organization;
use App\Models\PlantingMethod;
use App\Models\Process;
use App\Models\Section;
use App\Models\User;
use App\Models\Variety;
use Livewire\Component;

// Models
use App\Models\Field;

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

  private $organizationId;
  public $organization;

  private $harvestId;
  public $harvest;

  private $sectionId;
  public $section;

  private $cultureId;
  public $culture;

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
    $harvestConfiguration = HarvestConfiguration::where('field_id', $this->field)->first();
    $this->organizationId = $harvestConfiguration->organization_id;
    $this->harvestId = $harvestConfiguration->harvest_id;
    $this->sectionId = $harvestConfiguration->section_id;
    $this->cultureId = $harvestConfiguration->culture_id;

    $this->organization = Organization::where('id', $this->organizationId)->first();
    $this->organization = $this->organization->name;

    $this->harvest = Harvest::where('id', $this->harvestId)->first();
    $this->harvest = $this->harvest->name;

    $this->section = Section::where('id', $this->sectionId)->first();
    $this->section = $this->section->name;

    $this->culture = Culture::where('id', $this->cultureId)->first();
    $this->culture = $this->culture->name;
  }
}
