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
    $user = auth()->user();
    $data['organization'] = Organization::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['organization']) {
      return redirect()->route('structure-organizations');
    }

    return view('content.pages.structure.organization.update', $data);
  }

  public function organizationUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'external_code', 'situation']);
    $organizationUpdate = Organization::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$organizationUpdate) {
      return redirect()->route('structure-farms');
    }

    $organizationUpdate->code = strtoupper($update['code']);
    $organizationUpdate->name = strtoupper($update['name']);
    $organizationUpdate->external_code = strtoupper($update['external_code']);
    $organizationUpdate->situation = $update['situation'];
    $organizationUpdate->save();

    return redirect()->route('structure-organizations');
  }

  public function organizationDelete(int $id) {
    $user = auth()->user();
    Organization::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-organizations');
  }
}
