<?php

namespace App\Http\Controllers\pages\Sys;

use App\Http\Controllers\Controller;

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
}
