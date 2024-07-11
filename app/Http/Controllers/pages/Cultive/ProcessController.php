<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Process;

class ProcessController extends Controller {

  public function processes() {
    return view('content.pages.cultive.process.list');
  }

  public function processCreate() {
    return view('content.pages.cultive.process.create');
  }

  public function processUpdate(int $id) {
    return view('content.pages.cultive.process.update', compact('id'));
  }

  public function processDelete(int $id) {
    $user = auth()->user();
    Process::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-processes');
  }
}
