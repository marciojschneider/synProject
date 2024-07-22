<?php

namespace App\Livewire\Sys\User;

use Livewire\Component;
// Importações adicionais
use Illuminate\Support\Facades\Hash;
// Models
use App\Models\User;

class UserUpdate extends Component {
  //Register
  public $id, $user_update;
  // 1° Row
  public $name, $email, $password, $situation;

  public function mount() {
    $user = auth()->user();
    $this->user_update = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('users.id', $this->id)
      ->where('user_profiles.client_id', $user->in_client)->first();

    if (!$this->user_update) {
      return redirect()->route('sys-users');
    }

    $this->name = $this->user_update->name;
    $this->email = $this->user_update->email;
    $this->situation = $this->user_update->situation;
  }

  protected $rules = [
    'name' => 'required',
    'email' => ''
  ];

  public function submit() {
    $this->validate([
      'email' => 'required|email|unique:users,email,' . $this->id
    ]);

    $this->user_update->name = mb_strtoupper($this->name, 'UTF-8');
    $this->user_update->email = $this->email;
    if ($this->password) {
      $this->user_update->password = Hash::make($this->password);
    }
    $this->user_update->situation = $this->situation;
    $this->user_update->save();

    return redirect()->route('sys-users');
  }
}
