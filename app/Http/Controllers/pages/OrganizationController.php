<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller {
  public function organizations() {
    return view("content.pages.organization.list");
  }

  public function organizationCreate() {
    return view("content.pages.organization.create");
  }
  public function organizationCreateAction(Request $request) {
    dd($request);
  }

  public function organizationUpdate(int $id) {
    dd($id);
  }

  public function organizationUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function organizationDelete(int $id) {
    dd($id);
  }
}
