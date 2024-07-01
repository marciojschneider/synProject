<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachineHourController extends Controller {
  public function machineHours() {
    return view('content.pages.cultive.machine-hour.list');
  }

  public function machineHourCreate() {

  }

  public function machineHourCreateAction(Request $request) {

  }

  public function machineHourUpdate(int $id) {

  }

  public function machineHourUpdateAction(int $id, Request $request) {

  }

  public function machineHourDelete(int $id) {

  }
}
