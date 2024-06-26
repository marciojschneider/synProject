<?php

namespace App\Http\Controllers\pages\Cultive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Group;

class GroupController extends Controller {

  public function groups() {
    return view('content.pages.cultive.group.list');
  }

  public function groupCreate() {
    return view('content.pages.cultive.group.create');
  }

  public function groupCreateAction(Request $request) {
    $data = $request->only(['code', 'name']);

    $group = new Group();
    $group->code = mb_strtoupper($data['code'], 'UTF-8');
    $group->name = mb_strtoupper($data['name'], 'UTF-8');
    $group->save();

    return redirect()->route('cultive-groups');
  }

  public function groupUpdate(int $id) {
    $user = auth()->user();
    $data['group'] = Group::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['group']) {
      return redirect()->route('cultive-groups');
    }

    return view('content.pages.cultive.group.update', $data);
  }

  public function groupUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name']);
    $groupUpdate = Group::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$groupUpdate) {
      return redirect()->route('cultive-groups');
    }

    $groupUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $groupUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $groupUpdate->save();

    return redirect()->route('cultive-groups');
  }

  public function groupDelete(int $id) {
    $user = auth()->user();
    Group::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('cultive-groups');
  }
}
