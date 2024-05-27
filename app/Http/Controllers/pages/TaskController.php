<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\TaskDetail;
use Illuminate\Http\Request;

// Models
use App\Models\Task;

class TaskController extends Controller {
  public function index() {
    $tasks = Task::orderBy('created_at', 'DESC')->get();

    foreach ($tasks as $kTask => $vTask) {
      $data['tasks'][] = $vTask;

      switch ($vTask->situation) {
        case '1':
          $data['tasks'][$kTask]['cSituation'] = 'danger';
          $data['tasks'][$kTask]['nSituation'] = 'Não iniciada';
          break;

        case '2':
          $data['tasks'][$kTask]['cSituation'] = 'warning';
          $data['tasks'][$kTask]['nSituation'] = 'Pendente';
          break;

        case '3':
          $data['tasks'][$kTask]['cSituation'] = 'success';
          $data['tasks'][$kTask]['nSituation'] = 'Finalizada';
          break;

        case '4':
          $data['tasks'][$kTask]['cSituation'] = 'info';
          $data['tasks'][$kTask]['nSituation'] = 'Aprovada';
          break;

        default:
          $data['tasks'][$kTask]['cSituation'] = 'secondary';
          $data['tasks'][$kTask]['nSituation'] = 'Inativo';
          break;
      }
    }

    return view('content.pages.task.index', $data);
  }

  public function roadmap() {
    $tasks = Task::orderBy('created_at', 'DESC')->get();

    foreach ($tasks as $kTask => $vTask) {
      $data['tasks'][] = $vTask;

      switch ($vTask->situation) {
        case '1':
          $data['tasks'][$kTask]['cSituation'] = 'danger';
          $data['tasks'][$kTask]['nSituation'] = 'Não iniciada';
          break;

        case '2':
          $data['tasks'][$kTask]['cSituation'] = 'warning';
          $data['tasks'][$kTask]['nSituation'] = 'Pendente';
          break;

        case '3':
          $data['tasks'][$kTask]['cSituation'] = 'success';
          $data['tasks'][$kTask]['nSituation'] = 'Finalizada';
          break;

        case '4':
          $data['tasks'][$kTask]['cSituation'] = 'info';
          $data['tasks'][$kTask]['nSituation'] = 'Aprovada';
          break;

        default:
          $data['tasks'][$kTask]['cSituation'] = 'secondary';
          $data['tasks'][$kTask]['nSituation'] = 'Inativo';
          break;
      }

      $data['tasks'][$kTask]['details'] = TaskDetail::where('task_id', $vTask->id)->where('commit_reference', '!=', null)->orderBy('created_at', 'ASC')->get();
    }

    return view('content.pages.task.roadmap', $data);
  }
}
