<?php

namespace App\Livewire\Sys\Security\ProfilePermission;

use Livewire\Component;

// Models
use App\Models\Sidebar;
use App\Models\Profile;

class ProfilePermissionCreate extends Component {
  public $modules = [];
  public $module = null;

  public $screens = [];
  public $screen = null;

  public $profiles = [];
  public $profile = null;

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

  public function updatedModule() {
    $this->screens = Sidebar::where('icon', null)
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('affiliate_id', $this->module)
      ->get();
  }
}
