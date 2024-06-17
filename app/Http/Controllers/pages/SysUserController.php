<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importações adicionais
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\User;

class SysUserController extends Controller {
  public function users() {
    return view('content.pages.sys.user.list');
  }

  public function userCreate() {
    return view('content.pages.sys.user.create');
  }

  public function userCreateAction(Request $request) {
    $data = $request->only('name', 'email', 'password', 'situation');

    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|max:25'
    ]);

    $user = new User();
    $user->name = strtoupper($data['name']);
    $user->email = $data['email'];
    $user->password = Hash::make($data['password']);
    $user->situation = $data['situation'];
    $user->save();

    return redirect()->route('sys-users');
  }

  public function userUpdate(int $id) {
    $data['user'] = User::find($id);

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
