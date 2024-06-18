<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importações adicionais
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\User;
use App\Models\Profile;
use App\Models\UserProfile;

class SysUserController extends Controller {
  public function users() {
    return view('content.pages.sys.user.list');
  }

  public function userCreate() {
    return view('content.pages.sys.user.create');
  }

  public function userCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only('name', 'email', 'password', 'situation');

    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|max:25'
    ]);

    $userCreate = new User();
    $userCreate->name = strtoupper($data['name']);
    $userCreate->email = $data['email'];
    $userCreate->password = Hash::make($data['password']);
    $userCreate->situation = $data['situation'];
    $userCreate->save();

    $profileId = Profile::where('client_id', $user->in_client)->where('name', 'USUÁRIO')->select('id')->get();

    $userProfile = new UserProfile();
    $userProfile->user_id = $userCreate->id;
    $userProfile->profile_id = $profileId[0]->id;
    $userProfile->client_id = $user->in_client;
    $userProfile->creation_user = $user->id;
    $userProfile->save();

    return redirect()->route('sys-users');
  }

  public function userUpdate(int $id) {
    $user = auth()->user();
    $data['user'] = User::find($id);

    $verifyClient = UserProfile::where('client_id', $user->in_client)->where('user_id', $data['user']['id'])->first();

    if (!$verifyClient) {
      return redirect()->route('sys-users');
    }

    return view('content.pages.sys.user.update', $data);
  }

  public function userUpdateAction(int $id, Request $request) {
    $update = $request->only('name', 'password', 'situation');

    $userUpdate = User::find($id);
    $userUpdate->name = strtoupper($update['name']);
    if ($update['password']) {
      $userUpdate->password = Hash::make($update['password']);
    }
    $userUpdate->situation = $update['situation'];
    $userUpdate->save();

    return redirect()->route('sys-users');
  }

  public function userDelete(int $id) {
    User::where('id', $id)->delete();

    return redirect()->route('sys-users');
  }
}
