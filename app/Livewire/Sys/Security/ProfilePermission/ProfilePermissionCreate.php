<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;
// Models
use App\Models\profilePermission;
use App\Models\Sidebar;
use App\Models\Profile;

class ProfilePermissionCreate extends Component {
  // 1° Row
  public $modules = [], $module, $screens = [], $screen, $profiles = [], $profile, $situation = 1;
  // 2° Row
  public $description;
  // 3° Row
  public $viewCheck = true, $createCheck = false, $updateCheck = false, $deleteCheck = false;

  public function mount() {
    $user = auth()->user();

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->modules[0]['id'])
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  protected $rules = [
    'module' => 'required',
    'screen' => 'required',
    'profile' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $verifyUniqueModule = profilePermission::where('sidebar_id', $this->module)->where('profile_id', $this->profile)->first();
    if (!$verifyUniqueModule) {
      $moduleCreate = new profilePermission();
      $moduleCreate->profile_id = $this->profile;
      $moduleCreate->sidebar_id = $this->module;
      $moduleCreate->view = 1;
      $moduleCreate->creation_user = $user->id;
      $moduleCreate->client_id = $user->in_client;
      $moduleCreate->save();
    }

    $verifyUniqueScreen = profilePermission::where('sidebar_id', $this->screen)->where('profile_id', $this->profile)->first();
    if ($verifyUniqueScreen) {
      return redirect()->route('sys-sec-permissions');
    }

    $profile_permission = new profilePermission();
    $profile_permission->profile_id = $this->profile;
    $profile_permission->sidebar_id = $this->screen;
    $profile_permission->view = $this->viewCheck ? 1 : 0;
    $profile_permission->create = $this->createCheck ? 1 : 0;
    $profile_permission->update = $this->updateCheck ? 1 : 0;
    $profile_permission->delete = $this->deleteCheck ? 1 : 0;
    $profile_permission->description = mb_strtoupper($this->description, 'UTF-8');
    $profile_permission->situation = $this->situation;
    $profile_permission->client_id = $user->in_client;
    $profile_permission->creation_user = $user->id;
    $profile_permission->save();

    return redirect()->route('sys-sec-permissions');
  }

  // UPDATED Functions
  public function updatedModule() {
    if ($this->module) {
      $this->screens = Sidebar::where('icon', null)
        ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
        ->where('affiliate_id', $this->module)
        ->get();
    } else {
      $this->screen = null;
    }
  }
}
