<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\PlantingMethod;

class PlantingMethodController extends Controller {
  public function plantingMethods() {
    return view('content.pages.planting-method.list');
  }
}
