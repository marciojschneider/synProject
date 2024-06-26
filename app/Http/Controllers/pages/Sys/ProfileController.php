<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Client;
use App\Models\Profile;

class ProfileController extends Controller {
  public function profiles() {
    return view('content.pages.sys.profile.list');
  }

  public function profileCreate() {
    $user = auth()->user();
    $data['clients'] = Client::where('id', $user->in_client)->where('situation', 1)->get();

    return view('content.pages.sys.profile.create', $data);
  }

  public function profileCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['name', 'client', 'situation']);

    $profileCreate = new Profile();
    $profileCreate->name = mb_strtoupper($data['name'], 'UTF-8');
    $profileCreate->client_id = $data['client'];
    $profileCreate->creation_user = $user->id;
    $profileCreate->situation = $data['situation'];
    $profileCreate->save();

    // return redirect()->back()->with('success',''); → Redireciona para a própria página.
    return redirect()->route('sys-profiles');
  }

  public function profileUpdate(int $id) {
    $user = auth()->user();
    $data['clients'] = Client::where('id', $user->in_client)->where('situation', 1)->get();
    $data['profile'] = Profile::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['profile']) {
      return redirect()->route('sys-profiles');
    }

    return view('content.pages.sys.profile.update', $data);
  }

  public function profileUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['name', 'client', 'situation']);
    $profileUpdate = Profile::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$profileUpdate) {
      return redirect()->route('sys-profiles');
    }

    $profileUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $profileUpdate->client_id = $update['client'];
    $profileUpdate->situation = $update['situation'];
    $profileUpdate->save();

    return redirect()->route('sys-profiles');
  }

  public function profileDelete(int $id) {
    $user = auth()->user();
    Profile::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-profiles');
  }
}
