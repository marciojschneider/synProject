<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;
// Models
use App\Models\profilePermission;
use App\Models\Sidebar;
use App\Models\Profile;

class ProfilePermissionUpdate extends Component {
  // Register
  public $id, $profile_permission;

  // 1° Row
  public $modules = [], $module, $screens = [], $screen, $profiles = [], $profile, $situation;
  // 2° Row
  public $description;
  // 3° Row
  public $viewCheck = true, $createCheck = false, $updateCheck = false, $deleteCheck = false;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->profile_permission = profilePermission::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->profile_permission) {
      return redirect()->route('sys-sec-permissions');
    }
    // Selects
    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->get();
    // 1° Row
    $affiliate = Sidebar::where('id', $this->profile_permission->sidebar_id)->first();
    $module = Sidebar::where('id', $affiliate->affiliate_id)->first();
    $this->module = $module->id;

    // Select Screen with module
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();

    $this->screen = $this->profile_permission->sidebar_id;
    $this->profile = $this->profile_permission->profile_id;
    $this->situation = $this->profile_permission->situation;
    // 2° Row
    $this->description = $this->profile_permission->description;
    // 3° Row
    $this->viewCheck = $this->profile_permission->view == 1 ? true : false;
    $this->createCheck = $this->profile_permission->create == 1 ? true : false;
    $this->updateCheck = $this->profile_permission->update == 1 ? true : false;
    $this->deleteCheck = $this->profile_permission->delete == 1 ? true : false;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['screen' => $this->screen, 'module' => $this->module, 'profile' => $this->profile, 'situation' => $this->situation]);
  }

  protected $rules = [
    'module' => 'required',
    'screen' => 'required',
    'profile' => 'required',
  ];

  public function submit() {
    $this->validate();

    $verifyUniqueScreen = profilePermission::where('sidebar_id', $this->screen)->where('profile_id', $this->profile)->where('id', '!=', $this->id)->first();
    if ($verifyUniqueScreen) {
      return redirect()->route('sys-sec-permissions');
    }

    $this->profile_permission->sidebar_id = $this->screen;
    $this->profile_permission->profile_id = $this->profile;
    $this->profile_permission->view = $this->viewCheck ? 1 : 0;
    $this->profile_permission->create = $this->createCheck ? 1 : 0;
    $this->profile_permission->update = $this->updateCheck ? 1 : 0;
    $this->profile_permission->delete = $this->deleteCheck ? 1 : 0;
    $this->profile_permission->description = mb_strtoupper($this->description, 'UTF-8');
    $this->profile_permission->situation = $this->situation;
    $this->profile_permission->save();

    $needRemove = profilePermission::where('affiliate_id', $this->module)->where('profile_id', $this->profile)->where('view', 1)->get();
    if (count($needRemove) === 1) {
      switch ($needRemove[0]->sidebar_id) {
        case $this->module:
          $needRemove[0]->view = 0;
          $needRemove[0]->save();
          break;

        default:
          $needAdd = profilePermission::where('sidebar_id', $this->module)->where('profile_id', $this->profile)->get();
          $needAdd[0]->view = 1;
          $needAdd[0]->save();
          break;
      }
    }

    return redirect()->route('sys-sec-permissions');
  }
}
