<?php

namespace App\Http\Controllers\pages\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Task;
use App\Models\Sidebar;
use App\Models\TaskDetail;

class RoadmapController extends Controller {
  // Tasks
  public function tasks() {
    $user = auth()->user();
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '<', 4)->where('client_id', $user->in_client)->get();

    return view('content.pages.support.task.list', $data);
  }
  //         → Roadmap
  public function roadmap() {
    $user = auth()->user();
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '<', 4)->where('client_id', $user->in_client)->get();

    return view('content.pages.support.roadmap.list', $data);
  }

  public function roadmapAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['roadmapTask', 'roadmapCommit', 'roadmapDescription', 'roadmapDtSolicitation', 'roadmapDtFinal']);

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $data['roadmapTask'];
    $taskDetail->commit_reference = $data['roadmapCommit'];
    $taskDetail->description = mb_strtoupper($data['roadmapDescription'], 'UTF-8');
    $taskDetail->type = 1;
    $taskDetail->situation = 1;
    $taskDetail->creation_user = $user->id;
    $taskDetail->client_id = $user->in_client;
    $taskDetail->initial_dt = $data['roadmapDtSolicitation'];
    $taskDetail->ending_dt = $data['roadmapDtFinal'];
    $taskDetail->save();

    return redirect()->route('sup-roadmap');
  }

  public function roadmapUpdate(Request $request) {
    $user = auth()->user();
    $update = $request->only(['roadmapId', 'roadmapTask', 'roadmapCommit', 'roadmapDescription', 'roadmapDtSolicitation', 'roadmapDtFinal']);
    $taskUpdate = TaskDetail::where('id', $update['roadmapId'])->where('client_id', $user->in_client)->first();

    if (!$taskUpdate) {
      return redirect()->route('sup-tasks');
    }

    $taskUpdate->task_id = $update['roadmapTask'];
    $taskUpdate->commit_reference = $update['roadmapCommit'];
    $taskUpdate->description = mb_strtoupper($update['roadmapDescription'], 'UTF-8');
    $taskUpdate->initial_dt = $update['roadmapDtSolicitation'];
    $taskUpdate->ending_dt = $update['roadmapDtFinal'];
    $taskUpdate->save();

    return redirect()->route('sup-roadmap');
  }

  public function roadmapDelete(int $id) {
    $user = auth()->user();
    TaskDetail::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sup-roadmap');
  }
}
