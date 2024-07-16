<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
// Models
use App\Models\Field;

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

  public function fieldDelete(int $id) {
    $user = auth()->user();
    Field::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-fields');
  }
}
