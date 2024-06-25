<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Client;

class ClientController extends Controller {
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
    $clientCreate->code = mb_strtoupper($data['code'], 'UTF-8');
    $clientCreate->name = mb_strtoupper($data['name'], 'UTF-8');
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

    $clientUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $clientUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
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
