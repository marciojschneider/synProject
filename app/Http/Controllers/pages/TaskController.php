<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\TaskDetail;
use Illuminate\Http\Request;

// Models
use App\Models\Task;

class TaskController extends Controller {
  public function index() {
    $tasks = Task::all();

    foreach ($tasks as $kTask => $vTask) {
      $data['tasks'][] = $vTask;
      $data['tasks'][$kTask]['details'] = TaskDetail::where('task_id', $vTask->id)->get();
    }

    return view('content.pages.task.index', $data);
  }
}
