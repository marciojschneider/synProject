<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;

class CultureController extends Controller {
  public function cultures() {
    return view("content.pages.cultive.culture.list");
  }

  public function cultureCreate() {
    return view("content.pages.cultive.culture.create");
  }

  public function cultureUpdate(int $id) {
    return view('content.pages.cultive.culture.update', compact('id'));
  }
}
