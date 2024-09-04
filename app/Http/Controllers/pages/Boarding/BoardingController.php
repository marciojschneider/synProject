<?php

namespace App\Http\Controllers\pages\Boarding;

use App\Http\Controllers\Controller;

class BoardingController extends Controller {
  public function boardings() {
    return view('content.pages.boarding.boarding.list');
  }
}
