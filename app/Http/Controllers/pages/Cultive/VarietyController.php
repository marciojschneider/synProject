<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Culture;
use App\Models\Variety;
use App\Models\Group;

class VarietyController extends Controller {
  public function varieties() {
    return view('content.pages.cultive.variety.list');
  }

  public function varietyCreate() {
    return view('content.pages.cultive.variety.create');
  }

  public function varietyUpdate(int $id) {
    return view('content.pages.cultive.variety.update', compact('id'));
  }

  public function varietyDelete(int $id) {
    $user = auth()->user();
    Variety::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-varieties');
  }
}
