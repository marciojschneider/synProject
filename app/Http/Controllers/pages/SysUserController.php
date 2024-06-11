<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SysUserController extends Controller {
  public function users() {
    return view('content.pages.sys.user.list');
  }

  public function userCreate() {
    return view('content.pages.sys.user.create');
  }

  public function userCreateAction(Request $request) {
    dd($request);
  }

  public function userUpdate(int $id) {
    return view('content.pages.sys.user.update');
  }

  public function userUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function userDelete(int $id) {
    dd($id);
  }


}
