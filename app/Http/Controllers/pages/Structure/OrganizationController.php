<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Organization;

class OrganizationController extends Controller {
  public function organizations() {
    return view("content.pages.structure.organization.list");
  }

  public function organizationCreate() {
    return view("content.pages.structure.organization.create");
  }

  public function organizationUpdate(int $id) {
    return view('content.pages.structure.organization.update', compact('id'));
  }

  public function organizationDelete(int $id) {
    $user = auth()->user();
    Organization::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-organizations');
  }
}
