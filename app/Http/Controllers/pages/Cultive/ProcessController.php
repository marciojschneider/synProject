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

  public function processCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'type', 'situation']);

    $process = new Process();
    $process->code = mb_strtoupper($data['code'], 'UTF-8');
    $process->name = mb_strtoupper($data['name'], 'UTF-8');
    $process->type = $data['type'];
    $process->situation = $data['situation'];
    $process->save();

    return redirect()->route('cultive-processes');
  }

  public function processUpdate(int $id) {
    $user = auth()->user();
    $data['process'] = Process::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['process']) {
      return redirect()->route('cultive-varieties');
    }

    return view('content.pages.cultive.process.update', $data);
  }

  public function processUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'type', 'situation']);
    $processUpdate = Process::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$processUpdate) {
      return redirect()->route('cultive-varieties');
    }

    $processUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $processUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $processUpdate->type = $update['type'];
    $processUpdate->situation = $update['situation'];
    $processUpdate->save();

    return redirect()->route('cultive-processes');
  }

  public function processDelete(int $id) {
    $user = auth()->user();
    Process::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-processes');
  }
}
