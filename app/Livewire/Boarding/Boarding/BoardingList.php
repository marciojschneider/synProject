<?php

namespace App\Livewire\Boarding\Boarding;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;
use Livewire\Attributes\Session;
use Livewire\Attributes\On;

// Models
use App\Models\Boarding;
use App\Models\StBoarding;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\BoardingItem;
use App\Models\BoardingReading;
use App\Models\ProfilePermission;
use App\Models\StBoardingItem;
use App\Models\StBoardingReading;

class BoardingList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $pPage = 10;

  #[Session] public $boarding;
  #[Session] public $request;
  #[Session] public $erp;

  public $separadores = [];
  #[Session] public $separador;

  #[Session] public $situation = '1,2';

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $user = auth()->user();

    $this->separadores = UserProfile::where('profile_id', 5)
      ->join('users', 'users.id', '=', 'user_profiles.user_id')
      ->where('client_id', $user->in_client)
      ->where('user_profiles.situation', 1)
      ->get();
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['separador' => $this->separador, 'situation' => $this->situation]);
    $user = auth()->user();

    $query = Boarding::query();
    $stQuery = StBoarding::query();

    if (is_array($this->situation)) {
      $this->situation = implode(',', $this->situation);
    }
    $this->situation = explode(',', $this->situation);

    if (is_array($this->situation) && $this->situation[0] != '') {
      foreach ($this->situation as $key => $value) {
        if ($key === 0) {
          $query->where('situation', $value);
          $stQuery->where('situation', $value);
          $this->addWheres($query, $stQuery);
        } else {
          $query->orWhere('situation', $value);
          $stQuery->orWhere('situation', $value);
          $this->addWheres($query, $stQuery);
        }
      }
    }

    $stQuery->union($query)
      ->orderBy('date', 'desc')
      ->orderBy('number', 'desc')
      ->get();

    $data['rows'] = $stQuery->paginate($this->pPage);

    foreach ($data['rows'] as $kBoarding => $vBoarding) {
      $data['rows'][$kBoarding]['id'] = $vBoarding->id;

      if ($vBoarding->separador) {
        $separador = User::where('id', $vBoarding->separador)->select('name')->first();
        if ($separador) {
          $data['rows'][$kBoarding]['uName'] = $separador->name;
        }
      }

      switch ($vBoarding->situation) {
        case '1':
          $data['rows'][$kBoarding]['cSituation'] = 'danger';
          $data['rows'][$kBoarding]['nSituation'] = 'Sem separador';
          break;

        case '2':
          $data['rows'][$kBoarding]['cSituation'] = 'success';
          $data['rows'][$kBoarding]['nSituation'] = 'Sem leitura';
          break;

        case '3':
          $data['rows'][$kBoarding]['cSituation'] = 'warning';
          $data['rows'][$kBoarding]['nSituation'] = 'Com leitura';
          break;

        case '4':
          $data['rows'][$kBoarding]['cSituation'] = 'info';
          $data['rows'][$kBoarding]['nSituation'] = 'Finalizado';
          break;

        case '5':
          $data['rows'][$kBoarding]['cSituation'] = 'info';
          $data['rows'][$kBoarding]['nSituation'] = 'Exportado';
          break;
      }
    }

    return view('livewire.boarding.boarding.boarding-list', $data);
  }

  public function addWheres($query, $stQuery) {
    $user = auth()->user();

    $query->where('client_id', $user->in_client);
    $stQuery->where('client_id', $user->in_client);

    if ($user->in_profile == 5) {
      $query->where('separador', $user->id);
      $this->clean();
      $this->situation = '2,3';
    }

    if ($this->separador) {
      $query->where('separador', $this->separador);
      $stQuery->where('separador', $this->separador);
    }

    $this->addAdvancedFilters($query, $stQuery);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->separador = null;
    $this->situation = '1,2';
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query, $stQuery) {
    if ($this->advanced_filters) {
      if ($this->boarding) {
        $query->where('number', 'like', '%' . $this->boarding . '%');
        $stQuery->where('number', 'like', '%' . $this->boarding . '%');
      }
      if ($this->request) {
        $query->where('request', 'like', '%' . $this->request . '%');
        $stQuery->where('request', 'like', '%' . $this->request . '%');
      }
      if ($this->erp) {
        $query->where('request_erp', 'like', '%' . $this->erp . '%');
        $stQuery->where('request_erp', 'like', '%' . $this->erp . '%');
      }
    }
  }

  public function removeRegister(string $rName, int $id) {
    $user = auth()->user();

    $sqlPermission = ProfilePermission::join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->where('profile_permissions.profile_id', $user->in_profile)
      ->where('sidebars.url', 'like', '%' . $rName . '%')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('profile_permissions.delete', 1)
      ->get();

    if (!isset($sqlPermission[0]) || count($sqlPermission) === 0) {
      $this->dispatch('swal', [
        'title' => 'Sem Permissão',
        'icon' => 'error',
      ]);

      return;
    }

    $this->dispatch('swal', [
      'id' => $id
    ]);
  }

  #[On('removeAction')]
  public function removeAction(int $id) {
    $user = auth()->user();

    $boarding = Boarding::find($id);

    if ($boarding) {
      Boarding::where('id', $id)->where('client_id', $user->in_client)->delete();
      BoardingItem::where('boarding_id', $id)->delete();
      BoardingReading::where('boarding_id', $id)->delete();

      return redirect()->route('boar-boardings');
    }

    StBoarding::where('id', $id)->where('client_id', $user->in_client)->delete();
    StBoardingItem::where('boarding_id', $id)->delete();
    StBoardingReading::where('boarding_id', $id)->delete();

    return redirect()->route('boar-boardings');
  }
}
