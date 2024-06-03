<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Harvest;

class HarvestController extends Controller {
  public function harvests() {
    return view('content.pages.harvest.list');
  }
}
