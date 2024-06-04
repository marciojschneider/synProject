<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Process;

class CultiveProcessController extends Controller {
  public function processes() {
    return view('content.pages.process.list');
  }

  public function processCreate() {
    return view('content.pages.process.create');
  }

  public function processCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'type', 'situation']);

    $process = new Process();

    $process->code = $data['code'];
    $process->name = $data['name'];
    $process->type = $data['type'];
    $process->situation = $data['situation'];
    $process->save();

    return redirect()->route('cultive-processes');
  }

  public function processUpdate(int $id) {
    $data['process'] = Process::find($id);

    return view('content.pages.process.update', $data);
  }

  public function processUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'type', 'situation']);

    $processUpdate = Process::find($id);

    $processUpdate->code = $update['code'];
    $processUpdate->name = $update['name'];
    $processUpdate->type = $update['type'];
    $processUpdate->situation = $update['situation'];
    $processUpdate->save();

    return redirect()->route('cultive-processes');
  }

  public function processDelete(int $id) {
    Process::where('id', $id)->delete();

    return redirect()->route('cultive-processes');
  }
}
