<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {
  public function profiles() {
    return view('content.pages.profile.list');
  }
}
