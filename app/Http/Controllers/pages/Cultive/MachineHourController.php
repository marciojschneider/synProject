<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachineHourController extends Controller {
  public function machineHours() {
    return view('content.pages.cultive.machine-hour.list');
  }
}
