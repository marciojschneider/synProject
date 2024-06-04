<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HarvConfigController extends Controller {
  public function configurations() {
    return view('');
  }

  public function configurationCreate() {
    return view('');
  }

  public function configurationCreateAction(Request $request) {
    dd($request);
  }

  public function configurationUpdate(int $id) {
    return view('');
  }

  public function configurationUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function configurationDelete(int $id) {
    dd($id);
  }
}
