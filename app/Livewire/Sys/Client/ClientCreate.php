<?php

namespace App\Livewire\Sys\Client;

use App\Models\Profile;
use App\Models\profilePermission;
use App\Models\UserProfile;
use Livewire\Component;
// Models
use App\Models\Client;

class ClientCreate extends Component {
  // 1° Row
  public $code, $name, $url, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $client = new Client();

    $client->code = mb_strtoupper($this->code, 'UTF-8');
    $client->name = mb_strtoupper($this->name, 'UTF-8');
    $client->url = $this->url;
    $client->situation = $this->situation;
    $client->creation_user = $user->id;
    $client->save();

    $this->add_profiles_permissions($client->id);

    return redirect()->route('sys-clients');
  }

  public function add_profiles_permissions($client_id) {
    $user = auth()->user();

    $arr_profiles = ['USUÁRIO', 'ADMINISTRADOR'];
    $arr_permissions = [['module' => 1, 'screen' => 1], ['module' => 2, 'screen' => 2], ['module' => 2, 'screen' => 28], ['module' => 28, 'screen' => 6]];

    foreach ($arr_profiles as $arr_profile) {
      $profile = new Profile();
      $profile->name = $arr_profile;
      $profile->situation = 1;
      $profile->creation_user = $user->id;
      $profile->client_id = $client_id;
      $profile->save();

      switch ($arr_profile) {
        case 'ADMINISTRADOR':
          foreach ($arr_permissions as $arr_permission) {
            $profile_permission = new profilePermission();
            $profile_permission->profile_id = $profile->id;
            $profile_permission->sidebar_id = $arr_permission['screen'];
            $profile_permission->affiliate_id = $arr_permission['module'];
            $profile_permission->client_id = $client_id;
            $profile_permission->view = 1;
            $profile_permission->create = 1;
            $profile_permission->update = 1;
            $profile_permission->delete = 1;
            $profile_permission->situation = 1;
            $profile_permission->creation_user = $user->id;
            $profile_permission->save();
          }
          break;

        default:
          $profile_permission = new profilePermission();
          $profile_permission->profile_id = $profile->id;
          $profile_permission->sidebar_id = 1;
          $profile_permission->affiliate_id = 1;
          $profile_permission->client_id = $client_id;
          $profile_permission->view = 1;
          $profile_permission->create = 1;
          $profile_permission->update = 1;
          $profile_permission->delete = 1;
          $profile_permission->situation = 1;
          $profile_permission->creation_user = $user->id;
          $profile_permission->save();
          break;
      }
    }

    $user_profile = new UserProfile();
    $user_profile->user_id = $user->id;
    $user_profile->profile_id = $profile->id;
    $user_profile->client_id = $client_id;
    $user_profile->situation = 1;
    $user_profile->creation_user = $user->id;
    $user_profile->save();
  }
}
