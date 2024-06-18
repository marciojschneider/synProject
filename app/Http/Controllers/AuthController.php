<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;


// Importações adicionais (necessárias)
use Illuminate\Support\Facades\Auth;

// Models


class AuthController extends Controller {
  public function login() {
    if (Auth::check()) {
      Auth::logout();
    }

    return view('content.authentications.login');
  }

  public function loginAction(Request $request) {
    $dataLogin = $request->only(['email', 'password']);

    if (!Auth::attempt($dataLogin)) {
      $data['message'] = 'Usuário e/ou senha inválidos';
      $data['email'] = $dataLogin['email'];
      return view('content.authentications.login', $data);
    }

    if (Auth::user()->situation !== 1) {
      $data['message'] = 'Você não possui acesso ao sistema';
      $data['email'] = $dataLogin['email'];
      return view('content.authentications.login', $data);
    }

    return redirect()->route('select-client');
  }

  public function selectClient() {
    $user = Auth::user();

    $sql = UserProfile::join('clients', 'clients.id', '=', 'user_profiles.client_id')
      ->where('user_id', '=', $user->id)
      ->where('clients.situation', 1)
      ->where('user_profiles.situation', 1)
      ->select('clients.id as idClient', 'clients.name as nClient')
      ->groupBy('clients.id', 'clients.name')
      ->get();
    $data['clients'] = json_decode($sql, true);

    if (count($data['clients']) === 1) {
      $user->in_client = $data['clients'][0]['idClient'];
      $user->save();

      return redirect()->route('select-profile');
    }

    return view('content.authentications.select-client', $data);
  }

  public function selectClientAction(Request $request) {
    $user = auth()->user();

    $data = $request->only(['client_id']);

    $user->in_client = $data['client_id'];
    $user->save();

    return redirect()->route('select-profile');
  }

  public function selectProfile() {
    $user = Auth::user();

    $sql = UserProfile::join('profiles', 'profiles.id', '=', 'user_profiles.profile_id')
      ->where('user_id', '=', $user->id)
      ->where('profiles.situation', 1)
      ->where('user_profiles.client_id', '=', $user->in_client)
      ->where('user_profiles.situation', '=', 1)
      ->select('profiles.id as idProfile', 'profiles.name as nProfile')
      ->groupBy('profiles.id', 'profiles.name')
      ->get();
    $data['profiles'] = json_decode($sql, true);

    if (count($data['profiles']) === 1) {
      $user->in_time = now();
      $user->in_profile = $data['profiles'][0]['idProfile'];
      $user->save();

      return redirect()->route('homepage');
    }

    return view('content.authentications.select-profile', $data);
  }

  public function selectProfileAction(Request $request) {
    $user = auth()->user();

    $data = $request->only(['profile_id']);

    $user->in_time = now();
    $user->in_profile = $data['profile_id'];
    $user->save();

    return redirect()->route('homepage');
  }
}
