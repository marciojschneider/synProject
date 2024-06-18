<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Client;
use App\Models\Profile;
use App\Models\UserProfile;

class SysProfileController extends Controller {
  public function profiles() {
    return view('content.pages.sys.profile.list');
  }

  public function profileCreate() {
    $user = auth()->user();
    $data['clients'] = Client::where('id', $user->in_client)->get();

    return view('content.pages.sys.profile.create', $data);
  }

  public function profileCreateAction(Request $request) {
    $data = $request->only(['name', 'client', 'situation']);

    $profileCreate = new Profile();
    $profileCreate->name = strtoupper($data['name']);
    $profileCreate->client_id = $data['client'];
    $profileCreate->situation = $data['situation'];
    $profileCreate->save();

    // return redirect()->back()->with('success',''); → Redireciona para a própria página.
    return redirect()->route('sys-profiles');
  }

  public function profileUpdate(int $id) {
    $user = auth()->user();
    $data['profile'] = Profile::find($id);
    $data['clients'] = Client::where('id', $user->in_client)->get();

    $verifyClient = UserProfile::where('client_id', $user->in_client)->where('client_id', $data['profile']['id'])->first();

    if (!$verifyClient) {
      return redirect()->route('sys-profiles');
    }

    return view('content.pages.sys.profile.update', $data);
  }

  public function profileUpdateAction(int $id, Request $request) {
    $update = $request->only(['name', 'client', 'situation']);

    $profileUpdate = Profile::find($id);
    $profileUpdate->name = strtoupper($update['name']);
    $profileUpdate->client_id = $update['client'];
    $profileUpdate->situation = $update['situation'];
    $profileUpdate->save();

    return redirect()->route('sys-profiles');
  }

  public function profileDelete(int $id) {
    Profile::where('id', $id)->delete();

    return redirect()->route('sys-profiles');
  }
}
