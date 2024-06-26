<?php

namespace App\Http\Controllers\pages\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Task;
use App\Models\Sidebar;
use App\Models\TaskDetail;

class TaskController extends Controller {
  // Tasks
  public function tasks() {
    $user = auth()->user();
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '<', 4)->where('client_id', $user->in_client)->get();

    return view('content.pages.support.task.list', $data);
  }

  public function taskCreate() {
    // $uriAdjust = $request->route(); Forma de pegar a rota atual.
    $data['sidebars'] = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->where('client_id', 'REGEXP', '[[:<:]]' . auth()->user()->in_client . '[[:>:]]')
      ->where('visibility', 1)
      ->get();

    return view('content.pages.support.task.create', $data);
  }

  public function taskCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['title', 'sidebar', 'situation', 'solicitation', 'expectation', 'description']);

    $task = new Task();
    $task->title = mb_strtoupper($data['title'], 'UTF-8');
    $task->sidebar_id = $data['sidebar'];
    $task->initial_dt = $data['solicitation'];
    $task->expected_dt = $data['expectation'];
    $task->description = mb_strtoupper($data['description'], 'UTF-8');
    $task->situation = $data['situation'];
    $task->creation_user = $user->id;
    $task->client_id = $user->in_client;
    $task->save();

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $task->id;
    $taskDetail->description = mb_strtoupper($data['description'], 'UTF-8');
    $taskDetail->type = 2;
    $taskDetail->situation = 1;
    $task->creation_user = $user->id;
    $task->client_id = $user->in_client;
    $taskDetail->save();

    return redirect()->route('sup-tasks');
  }

  public function taskUpdate(int $id) {
    $user = auth()->user();
    $data['task'] = Task::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['task']) {
      return redirect()->route('sup-tasks');
    }

    return view('content.pages.support.task.update', compact('id'));
  }

  public function taskUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['title', 'situation', 'solicitation', 'expectation', 'description']);
    $taskUpdate = Task::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$taskUpdate) {
      return redirect()->route('sup-tasks');
    }

    $taskUpdate->title = mb_strtoupper($update['title'], 'UTF-8');
    // $taskUpdate->sidebar_id = $update['sidebar']; Disabled select (Just to view)!
    $taskUpdate->expected_dt = $update['expectation'];
    $taskUpdate->description = mb_strtoupper($update['description'], 'UTF-8');
    $taskUpdate->situation = $update['situation'];
    $taskUpdate->save();

    return redirect()->route('sup-tasks');
  }

  public function taskDelete(int $id) {
    $user = auth()->user();
    Task::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sup-tasks');
  }

  //         → Comments
  public function commentAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['commentTask', 'commentDescription']);

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $data['commentTask'];
    $taskDetail->description = mb_strtoupper($data['commentDescription'], 'UTF-8');
    $taskDetail->type = 2;
    $taskDetail->situation = 1;
    $taskDetail->creation_user = $user->id;
    $taskDetail->client_id = $user->in_client;
    $taskDetail->save();

    return redirect()->route('sup-tasks');
  }

  public function commentUpdate(Request $request) {
    $user = auth()->user();
    $update = $request->only(['commentId', 'commentTask', 'commentDescription']);
    $taskDetailUpdate = TaskDetail::where('id', $update['commentId'])->where('client_id', $user->in_client)->first();

    if (!$taskDetailUpdate) {
      return redirect()->route('sup-tasks');
    }

    $taskDetailUpdate->task_id = $update['commentTask'];
    $taskDetailUpdate->description = mb_strtoupper($update['commentDescription'], 'UTF-8');
    $taskDetailUpdate->save();

    return redirect()->route('sup-tasks');
  }

  public function commentDelete(int $id) {
    $user = auth()->user();
    TaskDetail::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sup-tasks');
  }
}
