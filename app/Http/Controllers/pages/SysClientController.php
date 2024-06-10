<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class SysClientController extends Controller {
  public function clients() {
    return view('content.pages.sys.client.list');
  }

  public function clientCreate() {
    return view('content.pages.sys.client.create');
  }

  public function clientCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'url', 'situation']);

    $client = new Client();
    $client->code = $data['code'];
    $client->name = $data['name'];
    $client->url = $data['url'];
    $client->situation = $data['situation'];
    $client->save();

    return redirect()->route('sys-clients');
  }

  public function clientUpdate(int $id) {
    $data['client'] = Client::find($id);

    return view('content.pages.sys.client.update', $data);
  }

  public function ClientUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'url', 'situation']);

    $clientUpdate = Client::find($id);
    $clientUpdate->code = $update['code'];
    $clientUpdate->name = $update['name'];
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
