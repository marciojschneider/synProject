<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;

// Models
use App\Models\Sidebar;
use App\Models\Profile;
use App\Models\profilePermission;

class ProfilePermissionUpdate extends Component {
  public $id;
  public $modules = [];
  public $module = null;

  public $profile_permission;

  public $screens = [];
  public $screen = null;

  public $profiles = [];
  public $profile = null;

  public function mount() {
    $user = auth()->user();
    $this->profile_permission = profilePermission::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->profile_permission) {
      return redirect()->route('sys-sec-permissions');
    }
    // abort(404);

    $affiliate = Sidebar::where('id', $this->profile_permission->sidebar_id)->first();
    $module = Sidebar::where('id', $affiliate->affiliate_id)->first();

    if (!$module) {
      return redirect()->route('sys-sec-permissions');
    }

    $this->module = $module->id;

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->get();

    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $affiliate->affiliate_id)
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->get();
  }

  public function updatedModule() {
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();
  }
}
