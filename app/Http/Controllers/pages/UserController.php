<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
  public function list() {
    return view('content.pages.pages-page2');
  }
}
