<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Task;
use App\Models\Sidebar;
use App\Models\TaskDetail;

class TaskController extends Controller {
  // Tasks
  public function tasks() {
    $tasks = Task::join('sidebars', 'sidebars.id', '=', 'tasks.sidebar_id')
      ->orderBy('situation', 'ASC')
      ->orderBy('created_at', 'DESC')
      ->select('tasks.*', 'sidebars.name as sName')
      ->get();
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '!=', 4)->get();

    foreach ($tasks as $kTask => $vTask) {
      $data['tasks'][] = $vTask;

      switch ($vTask->situation) {
        case '1':
          $data['tasks'][$kTask]['cSituation'] = 'danger';
          $data['tasks'][$kTask]['nSituation'] = 'Solicitado';
          break;

        case '2':
          $data['tasks'][$kTask]['cSituation'] = 'success';
          $data['tasks'][$kTask]['nSituation'] = 'Em desenvolvimento';
          break;

        case '3':
          $data['tasks'][$kTask]['cSituation'] = 'warning';
          $data['tasks'][$kTask]['nSituation'] = 'Pendente';
          break;

        case '4':
          $data['tasks'][$kTask]['cSituation'] = 'info';
          $data['tasks'][$kTask]['nSituation'] = 'Aprovado';
          break;

        default:
          $data['tasks'][$kTask]['cSituation'] = 'secondary';
          $data['tasks'][$kTask]['nSituation'] = 'Inativo';
          break;
      }

      $data['tasks'][$kTask]['details'] = TaskDetail::where('task_id', $vTask->id)->where('type', 2)->where('situation', 1)->orderBy('created_at', 'DESC')->get();
    }

    return view('content.pages.task.list', $data);
  }

  public function taskCreate() {
    // $uriAdjust = $request->route(); Forma de pegar a rota atual.
    $data['sidebars'] = Sidebar::where('icon', null)->get();

    return view('content.pages.task.create', $data);
  }

  public function taskCreateAction(Request $request) {
    $data = $request->only(['title', 'sidebar', 'situation', 'solicitation', 'expectation', 'description']);

    $task = new Task();
    $task->title = $data['title'];
    $task->sidebar_id = $data['sidebar'];
    $task->initial_dt = $data['solicitation'];
    $task->expected_dt = $data['expectation'];
    // $task->user_id = 0;
    $task->description = $data['description'];
    $task->situation = $data['situation'];
    $task->save();

    return redirect()->route('sup-tasks');
  }

  public function taskUpdate(int $id) {
    $data['sidebars'] = Sidebar::where('icon', null)->get();
    $data['task'] = Task::find($id);

    return view('content.pages.task.update', $data);
  }

  public function taskUpdateAction(int $id, Request $request) {
    $update = $request->only(['title', 'sidebar', 'situation', 'solicitation', 'expectation', 'description']);
    $taskUpdate = Task::find($id);

    $taskUpdate->title = $update['title'];
    $taskUpdate->sidebar_id = $update['sidebar'];
    $taskUpdate->expected_dt = $update['expectation'];
    $taskUpdate->description = $update['description'];
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
    $taskDetail->description = $data['commentDescription'];
    $taskDetail->type = 2;
    $taskDetail->situation = 1;
    $taskDetail->save();

    return redirect()->route('sup-tasks');
  }

  public function commentUpdate(Request $request) {
    $update = $request->only(['commentId', 'commentTask', 'commentDescription']);
    $taskUpdate = TaskDetail::find($update['commentId']);

    $taskUpdate->task_id = $update['commentTask'];
    $taskUpdate->description = $update['commentDescription'];
    $taskUpdate->save();

    return redirect()->route('sup-tasks');
  }

  public function commentDelete(int $id) {
    TaskDetail::where('id', $id)->delete();

    return redirect()->route('sup-tasks');
  }

  //         → Roadmap
  public function roadmap() {
    $tasks = Task::join('sidebars', 'sidebars.id', '=', 'tasks.sidebar_id')
      ->orderBy('situation', 'ASC')
      ->orderBy('created_at', 'DESC')
      ->select('tasks.*', 'sidebars.name as sName')
      ->get();
    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '!=', 4)->get();

    foreach ($tasks as $kTask => $vTask) {
      $data['tasks'][] = $vTask;

      switch ($vTask->situation) {
        case '1':
          $data['tasks'][$kTask]['cSituation'] = 'danger';
          $data['tasks'][$kTask]['nSituation'] = 'Solicitado';
          break;

        case '2':
          $data['tasks'][$kTask]['cSituation'] = 'success';
          $data['tasks'][$kTask]['nSituation'] = 'Em desenvolvimento';
          break;

        case '3':
          $data['tasks'][$kTask]['cSituation'] = 'warning';
          $data['tasks'][$kTask]['nSituation'] = 'Pendente';
          break;

        case '4':
          $data['tasks'][$kTask]['cSituation'] = 'info';
          $data['tasks'][$kTask]['nSituation'] = 'Aprovado';
          break;

        default:
          $data['tasks'][$kTask]['cSituation'] = 'secondary';
          $data['tasks'][$kTask]['nSituation'] = 'Inativo';
          break;
      }

      $data['tasks'][$kTask]['details'] = TaskDetail::where('task_id', $vTask->id)->where('type', 1)->where('situation', 1)->orderBy('created_at', 'DESC')->get();
    }

    return view('content.pages.task.roadmap', $data);
  }

  public function roadmapAction(Request $request) {
    $data = $request->only(['roadmapTask', 'roadmapCommit', 'roadmapDescription', 'roadmapDtSolicitation', 'roadmapDtFinal']);

    $taskDetail = new TaskDetail();
    $taskDetail->task_id = $data['roadmapTask'];
    $taskDetail->commit_reference = $data['roadmapCommit'];
    $taskDetail->description = $data['roadmapDescription'];
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
    $taskUpdate->description = $update['roadmapDescription'];
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
