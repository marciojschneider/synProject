<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Group;

class CultiveGroupController extends Controller {
  public function groups() {
    return view('content.pages.cultive.group.list');
  }

  public function groupCreate() {
    return view('content.pages.cultive.group.create');
  }

  public function groupCreateAction(Request $request) {
    $data = $request->only(['code', 'name']);

    $group = new Group();

    $group->code = $data['code'];
    $group->name = $data['name'];

    $group->save();

    return redirect()->route('cultive-groups');
  }

  public function groupUpdate(int $id) {
    $data['group'] = Group::find($id);

    return view('content.pages.cultive.group.update', $data);
  }

  public function groupUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name']);

    $groupUpdate = Group::find($id);

    $groupUpdate->code = $update['code'];
    $groupUpdate->name = $update['name'];
    $groupUpdate->save();

    return redirect()->route('cultive-groups');
  }

  public function groupDelete(int $id) {
    Group::where('id', $id)->delete();

    return redirect()->route('cultive-groups');
  }
}
