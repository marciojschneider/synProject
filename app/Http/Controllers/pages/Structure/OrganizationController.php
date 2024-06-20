<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller {
  public function organizations() {
    return view("content.pages.structure.organization.list");
  }

  public function organizationCreate() {
    return view("content.pages.structure.organization.create");
  }
  public function organizationCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'external_code', 'situation']);

    $organization = new Organization();
    $organization->code = strtoupper($data['code']);
    $organization->name = strtoupper($data['name']);
    $organization->external_code = strtoupper($data['external_code']);
    $organization->situation = $data['situation'];
    $organization->save();

    return redirect()->route('structure-organizations');
  }

  public function organizationUpdate(int $id) {
    $data['organization'] = Organization::find($id);
    return view('content.pages.structure.organization.update', $data);
  }

  public function organizationUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'external_code', 'situation']);

    $organizationUpdate = Organization::find($id);
    $organizationUpdate->code = strtoupper($update['code']);
    $organizationUpdate->name = strtoupper($update['name']);
    $organizationUpdate->external_code = strtoupper($update['external_code']);
    $organizationUpdate->situation = $update['situation'];
    $organizationUpdate->save();

    return redirect()->route('structure-organizations');
  }

  public function organizationDelete(int $id) {
    Organization::where('id', $id)->delete();
    return redirect()->route('structure-organizations');
  }
}
