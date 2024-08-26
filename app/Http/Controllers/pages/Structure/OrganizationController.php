<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

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
}
