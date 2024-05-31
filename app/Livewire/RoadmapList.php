<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;

// Models
use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\Sidebar;

class RoadmapList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $sidebars;

  // Variaveis
  public $searchText;
  public $sidebar;
  public $situation;
  public $pPage = 5;

  public function mount() {
    $this->sidebars = Sidebar::where('icon', null)->get();
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = Task::query();

    $query->join('sidebars', 'sidebars.id', '=', 'tasks.sidebar_id')
      ->orderBy('situation', 'ASC')
      ->orderBy('created_at', 'DESC')
      ->select('tasks.*', 'sidebars.name as sName')
      ->get();

    if ($this->sidebar) {
      $query->where('sidebar_id', $this->sidebar);
    }

    if ($this->situation) {
      $query->where('situation', $this->situation);
    }

    $data['rows'] = $query->paginate($this->pPage);

    $data['unapproveds'] = Task::orderBy('created_at', 'DESC')->where('situation', '!=', 4)->get();

    foreach ($data['rows'] as $kTask => $vTask) {
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

      $data['rows'][$kTask]['details'] = TaskDetail::where('task_id', $vTask->id)->where('type', 1)->where('situation', 1)->orderBy('created_at', 'DESC')->get();
    }

    return view('livewire.roadmap-list', $data);
  }
}
