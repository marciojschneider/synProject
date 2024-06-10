<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Client;
use App\Models\Profile;

class SysProfileController extends Controller {
  public function profiles() {
    return view('content.pages.sys.profile.list');
  }

  public function profileCreate() {
    $data['clients'] = Client::all();

    return view('content.pages.sys.profile.create', $data);
  }

  public function profileCreateAction(Request $request) {
    $data = $request->only(['name', 'client', 'situation']);

    $profile = new Profile();
    $profile->name = $data['name'];
    $profile->client_id = $data['client'];
    $profile->situation = $data['situation'];
    $profile->save();

    // return redirect()->back()->with('success',''); → Redireciona para a própria página.
    return redirect()->route('sys-profiles');
  }

  public function profileUpdate(int $id) {
    $data['profile'] = Profile::find($id);
    $data['clients'] = Client::all();

    return view('content.pages.sys.profile.update', $data);
  }

  public function profileUpdateAction(int $id, Request $request) {
    $update = $request->only(['name', 'client', 'situation']);
    $profileUpdate = Profile::find($id);

    $profileUpdate->name = $update['name'];
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
