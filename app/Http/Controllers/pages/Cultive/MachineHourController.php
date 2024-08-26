<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

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
}
