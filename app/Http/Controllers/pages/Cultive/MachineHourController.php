<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
// Models
use App\Models\MachineHour;

class MachineHourController extends Controller {
  public function machineHours() {
    return view('content.pages.cultive.machine-hour.list');
  }

  public function machineHourCreate() {
    return view('content.pages.cultive.machine-hour.create');
  }

  public function machineHourUpdate(int $id) {
    return view('content.pages.cultive.machine-hour.update', compact('id'));
  }

  public function machineHourDelete(int $id) {
    $user = auth()->user();
    MachineHour::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-machine-hours');
  }
}
