<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ProfileController extends Controller {
  public function profiles() {
    return view('content.pages.profile.list');
  }

  public function profileCreate() {
    $data['clients'] = Client::all();

    return view('content.pages.profile.create', $data);
  }

  public function profileCreateAction(Request $request) {
    dd($request);
  }
}
