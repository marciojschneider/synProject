<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Task;
use App\Models\Sidebar;
use App\Models\TaskDetail;

class SupTaskController extends Controller {
  // Tasks
  public function tasks() {
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '<', 4)->get();

    return view('content.pages.sup.task.list', $data);
  }

  public function taskCreate() {
    // $uriAdjust = $request->route(); Forma de pegar a rota atual.
    $data['sidebars'] = Sidebar::where('icon', null)->get();

    return view('content.pages.sup.task.create', $data);
  }

  public function taskCreateAction(Request $request) {
    $data = $request->only(['title', 'sidebar', 'situation', 'solicitation', 'expectation', 'description']);

    $task = new Task();
    $task->title = strtoupper($data['title']);
    $task->sidebar_id = $data['sidebar'];
    $task->initial_dt = $data['solicitation'];
    $task->expected_dt = $data['expectation'];
    // $task->user_id = 0;
    $task->description = strtoupper($data['description']);
    $task->situation = $data['situation'];
    $task->save();

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $task->id;
    $taskDetail->description = strtoupper($data['description']);
    $taskDetail->type = 2;
    $taskDetail->situation = 1;
    $taskDetail->save();

    return redirect()->route('sup-tasks');
  }

  public function taskUpdate(int $id) {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['task'] = Task::find($id);

    return view('content.pages.sup.task.update', $data);
  }

  public function taskUpdateAction(int $id, Request $request) {
    $update = $request->only(['title', 'situation', 'solicitation', 'expectation', 'description']);

    $taskUpdate = Task::find($id);
    $taskUpdate->title = strtoupper($update['title']);
    // $taskUpdate->sidebar_id = $update['sidebar']; Disabled select (Just to view)!
    $taskUpdate->expected_dt = $update['expectation'];
    $taskUpdate->description = strtoupper($update['description']);
    $taskUpdate->situation = $update['situation'];
    $taskUpdate->save();

    return redirect()->route('sup-tasks');
  }

  public function taskDelete(int $id) {
    Task::where('id', $id)->delete();

    return redirect()->route('sup-tasks');
  }


  //         → Comments
  public function commentAction(Request $request) {
    $data = $request->only(['commentTask', 'commentDescription']);

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $data['commentTask'];
    $taskDetail->description = strtoupper($data['commentDescription']);
    $taskDetail->type = 2;
    $taskDetail->situation = 1;
    $taskDetail->save();

    return redirect()->route('sup-tasks');
  }

  public function commentUpdate(Request $request) {
    $update = $request->only(['commentId', 'commentTask', 'commentDescription']);

    $taskUpdate = TaskDetail::find($update['commentId']);
    $taskUpdate->task_id = $update['commentTask'];
    $taskUpdate->description = strtoupper($update['commentDescription']);
    $taskUpdate->save();

    return redirect()->route('sup-tasks');
  }

  public function commentDelete(int $id) {
    TaskDetail::where('id', $id)->delete();

    return redirect()->route('sup-tasks');
  }

  //         → Roadmap
  public function roadmap() {
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '<', 4)->get();

    return view('content.pages.sup.task.roadmap', $data);
  }

  public function roadmapAction(Request $request) {
    $data = $request->only(['roadmapTask', 'roadmapCommit', 'roadmapDescription', 'roadmapDtSolicitation', 'roadmapDtFinal']);

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $data['roadmapTask'];
    $taskDetail->commit_reference = $data['roadmapCommit'];
    $taskDetail->description = strtoupper($data['roadmapDescription']);
    $taskDetail->type = 1;
    $taskDetail->situation = 1;
    $taskDetail->initial_dt = $data['roadmapDtSolicitation'];
    $taskDetail->ending_dt = $data['roadmapDtFinal'];
    $taskDetail->save();

    return redirect()->route('sup-roadmap');
  }

  public function roadmapUpdate(Request $request) {
    $update = $request->only(['roadmapId', 'roadmapTask', 'roadmapCommit', 'roadmapDescription', 'roadmapDtSolicitation', 'roadmapDtFinal']);

    $taskUpdate = TaskDetail::find($update['roadmapId']);
    $taskUpdate->task_id = $update['roadmapTask'];
    $taskUpdate->commit_reference = $update['roadmapCommit'];
    $taskUpdate->description = strtoupper($update['roadmapDescription']);
    $taskUpdate->initial_dt = $update['roadmapDtSolicitation'];
    $taskUpdate->ending_dt = $update['roadmapDtFinal'];
    $taskUpdate->save();

    return redirect()->route('sup-roadmap');
  }

  public function roadmapDelete(int $id) {
    TaskDetail::where('id', $id)->delete();

    return redirect()->route('sup-roadmap');
  }
}
