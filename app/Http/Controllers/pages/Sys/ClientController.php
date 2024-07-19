<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;
// Models
use App\Models\Client;

class ClientController extends Controller {
  public function clients() {
    return view('content.pages.sys.client.list');
  }

  public function clientCreate() {
    return view('content.pages.sys.client.create');
  }

  public function clientUpdate(int $id) {
    return view('content.pages.sys.client.update', compact('id'));
  }

  public function clientDelete(int $id) {
    Client::where('id', $id)->delete();

    return redirect()->route('sys-clients');
  }
}
