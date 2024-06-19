<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Client;
use App\Models\UserProfile;

class SysClientController extends Controller {
  public function clients() {
    return view('content.pages.sys.client.list');
  }

  public function clientCreate() {
    return view('content.pages.sys.client.create');
  }

  public function clientCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'url', 'situation']);

    $clientCreate = new Client();
    $clientCreate->code = strtoupper($data['code']);
    $clientCreate->name = strtoupper($data['name']);
    $clientCreate->url = $data['url'];
    $clientCreate->situation = $data['situation'];
    $clientCreate->creation_user = $user->id;
    $clientCreate->save();

    return redirect()->route('sys-clients');
  }

  public function clientUpdate(int $id) {
    $data['client'] = Client::find($id);

    if (!$data['client']) {
      return redirect()->route('sys-clients');
    }

    return view('content.pages.sys.client.update', $data);
  }

  public function ClientUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'url', 'situation']);
    $clientUpdate = Client::find($id);

    if (!$clientUpdate) {
      return redirect()->route('sys-clients');
    }

    $clientUpdate->code = strtoupper($update['code']);
    $clientUpdate->name = strtoupper($update['name']);
    $clientUpdate->url = $update['url'];
    $clientUpdate->situation = $update['situation'];
    $clientUpdate->save();

    return redirect()->route('sys-clients');
  }
  public function clientDelete(int $id) {
    Client::where('id', $id)->delete();

    return redirect()->route('sys-clients');
  }
}
