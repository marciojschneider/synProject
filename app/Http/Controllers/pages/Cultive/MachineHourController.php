<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use App\Models\MachineHour;
use Illuminate\Http\Request;

class MachineHourController extends Controller {
  public function machineHours() {
    return view('content.pages.cultive.machine-hour.list');
  }

  public function machineHourCreate() {
    return view('content.pages.cultive.machine-hour.create');
  }

  public function machineHourCreateAction(Request $request) {
    $user = auth()->user();

    $data = $request->only(['report', 'field', 'organization', 'harvest', 'section', 'culture', 'transaction_type', 'transaction_dt', 'operator',
      'process', 'planting_method', 'variety', 'equipament', 'implement', 'hourmeter_start', 'hourmeter_end', 'hourmeter_quantity', 'box_quantity',
      'hourmeter_rotor_start', 'hourmeter_rotor_end', 'hourmeter_rotor_quantity', 'operator_start', 'operator_end', 'stop_reason', 'description',
      'stop_hour', 'quantity_diesel', 'hourmeter_diesel']);

    $machineHourCreate = new MachineHour();
    $machineHourCreate->report = $data['report'];
    $machineHourCreate->transaction_type = $data['transaction_type'];
    $machineHourCreate->transaction_dt = $data['transaction_dt'];
    $machineHourCreate->harvest_id = $data['harvest'];
    $machineHourCreate->organization_id = $data['organization'];
    $machineHourCreate->section_id = $data['section'];
    $machineHourCreate->field_id = $data['field'];
    $machineHourCreate->culture_id = $data['culture'];
    $machineHourCreate->variety_id = $data['variety'];
    $machineHourCreate->planting_method_id = $data['planting_method'];
    $machineHourCreate->process_id = $data['process'];
    $machineHourCreate->equipament_id = $data['equipament'];
    $machineHourCreate->implement_id = $data['implement'];
    $machineHourCreate->user_id = $data['operator'];
    $machineHourCreate->hourmeter_quantity = $data['hourmeter_quantity'];
    $machineHourCreate->hourmeter_start = $data['hourmeter_start'];
    $machineHourCreate->hourmeter_end = $data['hourmeter_end'];
    if ($data['stop_reason']) {
      $machineHourCreate->stop_reason = $data['stop_reason'];
      $machineHourCreate->stop_description = $data['description'];
      $machineHourCreate->stop_hour = $data['stop_hour'];
    }
    if ($data['stop_reason'] == 3) {
      $machineHourCreate->quantity_diesel = $data['quantity_diesel'];
      $machineHourCreate->hourmeter_diesel = $data['hourmeter_diesel'];
    }
    $machineHourCreate->operator_start = $data['operator_start'];
    $machineHourCreate->operator_end = $data['operator_end'];
    $machineHourCreate->quantity_box = $data['box_quantity'];
    $machineHourCreate->hourmeter_rotor_start = $data['hourmeter_rotor_start'];
    $machineHourCreate->hourmeter_rotor_end = $data['hourmeter_rotor_end'];
    $machineHourCreate->hourmeter_rotor_quantity = $data['hourmeter_rotor_quantity'];
    $machineHourCreate->creation_user = $user->id;
    $machineHourCreate->client_id = $user->in_client;
    $machineHourCreate->save();

    return redirect()->route('cultive-machine-hours');
  }

  public function machineHourUpdate(int $id) {
    return view('content.pages.cultive.machine-hour.update', compact('id'));
  }

  public function machineHourUpdateAction(int $id, Request $request) {

  }

  public function machineHourDelete(int $id) {
    $user = auth()->user();
    MachineHour::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-machine-hours');
  }
}
