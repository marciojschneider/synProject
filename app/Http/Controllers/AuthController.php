<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// Importações adicionais (necessárias)
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function login() {
    return view('content.authentications.login');
  }

  public function loginAction(Request $request) {
    $dataLogin = $request->only(['email', 'password']);

    if (!Auth::attempt($dataLogin)) {
      $data['message'] = 'Usuário e/ou senha inválidos';
      $data['email'] = $dataLogin['email'];
      return view('content.authentications.login', $data);
    }

    return redirect()->route('homepage');

  }
}
