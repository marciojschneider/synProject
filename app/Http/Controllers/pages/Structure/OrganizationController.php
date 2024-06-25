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
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'external_code', 'situation']);

    $organization = new Organization();
    $organization->code = mb_strtoupper($data['code'], 'UTF-8');
    $organization->name = mb_strtoupper($data['name'], 'UTF-8');
    $organization->external_code = mb_strtoupper($data['external_code'], 'UTF-8');
    $organization->situation = $data['situation'];
    $organization->creation_user = $user->id;
    $organization->client_id = $user->in_client;
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

    $organizationUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $organizationUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $organizationUpdate->external_code = mb_strtoupper($update['external_code'], 'UTF-8');
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
