<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;

class FieldController extends Controller {
  public function fields() {
    return view('content.pages.structure.field.list');
  }

  public function fieldCreate() {
    return view('content.pages.structure.field.create');
  }

  public function fieldUpdate(int $id) {
    return view('content.pages.structure.field.update', compact('id'));
  }
}
