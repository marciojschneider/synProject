<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class StructureOrganizationController extends Controller {
  public function organizations() {
    return view("content.pages.organization.list");
  }

  public function organizationCreate() {
    return view("content.pages.organization.create");
  }
  public function organizationCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'machine_hour_dt', 'ordinance_dt', 'maintenance_dt', 'fuel_dt', 'harvest_dt', 'inputs_dt', 'external_code', 'situation']);
    $organization = new Organization();

    $organization->code = $data['code'];
    $organization->name = $data['name'];
    $organization->machine_hour_dt = $data['machine_hour_dt'];
    $organization->ordinance_dt = $data['ordinance_dt'];
    $organization->maintenance_dt = $data['maintenance_dt'];
    $organization->fuel_dt = $data['fuel_dt'];
    $organization->harvest_dt = $data['harvest_dt'];
    $organization->inputs_dt = $data['inputs_dt'];
    $organization->external_code = $data['external_code'];
    $organization->situation = $data['situation'];

    $organization->save();

    return redirect()->route('structure-organizations');
  }

  public function organizationUpdate(int $id) {
    $data['organization'] = Organization::find($id);
    return view('content.pages.organization.update', $data);
  }

  public function organizationUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'machine_hour_dt', 'ordinance_dt', 'maintenance_dt', 'fuel_dt', 'harvest_dt', 'inputs_dt', 'external_code', 'situation']);
    $organizationUpdate = Organization::find($id);

    $organizationUpdate->code = $update['code'];
    $organizationUpdate->name = $update['name'];
    $organizationUpdate->machine_hour_dt = $update['machine_hour_dt'];
    $organizationUpdate->ordinance_dt = $update['ordinance_dt'];
    $organizationUpdate->maintenance_dt = $update['maintenance_dt'];
    $organizationUpdate->fuel_dt = $update['fuel_dt'];
    $organizationUpdate->harvest_dt = $update['harvest_dt'];
    $organizationUpdate->inputs_dt = $update['inputs_dt'];
    $organizationUpdate->external_code = $update['external_code'];
    $organizationUpdate->situation = $update['situation'];

    $organizationUpdate->save();

    return redirect()->route('structure-organizations');
  }

  public function organizationDelete(int $id) {
    Organization::where('id', $id)->delete();
    return redirect()->route('structure-organizations');
  }
}
