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
    $machineHourCreate->hourmeter_start = $this->formatNumberValue($data['hourmeter_start']);
    $machineHourCreate->hourmeter_end = $this->formatNumberValue($data['hourmeter_end']);
    $machineHourCreate->hourmeter_quantity = $this->formatNumberValue($data['hourmeter_quantity']);
    if ($data['stop_reason']) {
      $machineHourCreate->stop_reason = $data['stop_reason'];
      $machineHourCreate->stop_description = $data['description'];
      $machineHourCreate->stop_hour = $data['stop_hour'];
    }
    if ($data['stop_reason'] == 3) {
      $machineHourCreate->quantity_diesel = $this->formatNumberValue($data['quantity_diesel']);
      $machineHourCreate->hourmeter_diesel = $this->formatNumberValue($data['hourmeter_diesel']);
    }
    $machineHourCreate->operator_start = $data['operator_start'];
    $machineHourCreate->operator_end = $data['operator_end'];
    $machineHourCreate->quantity_box = $this->formatNumberValue($data['box_quantity']);
    $machineHourCreate->hourmeter_rotor_start = $this->formatNumberValue($data['hourmeter_rotor_start']);
    $machineHourCreate->hourmeter_rotor_end = $this->formatNumberValue($data['hourmeter_rotor_end']);
    $machineHourCreate->hourmeter_rotor_quantity = $this->formatNumberValue($data['hourmeter_rotor_quantity']);
    $machineHourCreate->creation_user = $user->id;
    $machineHourCreate->client_id = $user->in_client;
    $machineHourCreate->save();

    return redirect()->route('cultive-machine-hours');
  }

  public function machineHourUpdate(int $id) {
    return view('content.pages.cultive.machine-hour.update', compact('id'));
  }

  public function machineHourUpdateAction(int $id, Request $request) {
    $user = auth()->user();

    $update = $request->only(['report', 'field', 'organization', 'harvest', 'section', 'culture', 'transaction_type', 'transaction_dt', 'operator',
      'process', 'planting_method', 'variety', 'equipament', 'implement', 'hourmeter_start', 'hourmeter_end', 'hourmeter_quantity', 'box_quantity',
      'hourmeter_rotor_start', 'hourmeter_rotor_end', 'hourmeter_rotor_quantity', 'operator_start', 'operator_end', 'stop_reason', 'description',
      'stop_hour', 'quantity_diesel', 'hourmeter_diesel']);

    $machineHourUpdate = MachineHour::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$machineHourUpdate) {
      return redirect()->route('cultive-machine-hours');
    }

    $machineHourUpdate->report = $update['report'];
    $machineHourUpdate->transaction_type = $update['transaction_type'];
    $machineHourUpdate->transaction_dt = $update['transaction_dt'];
    $machineHourUpdate->harvest_id = $update['harvest'];
    $machineHourUpdate->organization_id = $update['organization'];
    $machineHourUpdate->section_id = $update['section'];
    $machineHourUpdate->field_id = $update['field'];
    $machineHourUpdate->culture_id = $update['culture'];
    $machineHourUpdate->variety_id = $update['variety'];
    $machineHourUpdate->planting_method_id = $update['planting_method'];
    $machineHourUpdate->process_id = $update['process'];
    $machineHourUpdate->equipament_id = $update['equipament'];
    $machineHourUpdate->implement_id = $update['implement'];
    $machineHourUpdate->user_id = $update['operator'];
    $machineHourUpdate->hourmeter_start = $this->formatNumberValue($update['hourmeter_start']);
    $machineHourUpdate->hourmeter_end = $this->formatNumberValue($update['hourmeter_end']);
    $machineHourUpdate->hourmeter_quantity = $this->formatNumberValue($update['hourmeter_quantity']);
    if ($update['stop_reason']) {
      $machineHourUpdate->stop_reason = $update['stop_reason'];
      $machineHourUpdate->stop_description = $update['description'];
      $machineHourUpdate->stop_hour = $update['stop_hour'];
    }
    if ($update['stop_reason'] == 3) {
      $machineHourUpdate->quantity_diesel = $this->formatNumberValue($update['quantity_diesel']);
      $machineHourUpdate->hourmeter_diesel = $this->formatNumberValue($update['hourmeter_diesel']);
    }
    $machineHourUpdate->operator_start = $update['operator_start'];
    $machineHourUpdate->operator_end = $update['operator_end'];
    $machineHourUpdate->quantity_box = $this->formatNumberValue($update['box_quantity']);
    $machineHourUpdate->hourmeter_rotor_start = $this->formatNumberValue($update['hourmeter_rotor_start']);
    $machineHourUpdate->hourmeter_rotor_end = $this->formatNumberValue($update['hourmeter_rotor_end']);
    $machineHourUpdate->hourmeter_rotor_quantity = $this->formatNumberValue($update['hourmeter_rotor_quantity']);
    $machineHourUpdate->creation_user = $user->id;
    $machineHourUpdate->client_id = $user->in_client;
    $machineHourUpdate->save();

    return redirect()->route('cultive-machine-hours');
  }

  public function machineHourDelete(int $id) {
    $user = auth()->user();
    MachineHour::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-machine-hours');
  }

  // AUX Functions
  private function formatNumberValue($value) {
    $formated = implode('', explode('.', $value));
    return number_format(floatval(implode('.', explode(',', $formated))), 2, '.', '');
  }
}
