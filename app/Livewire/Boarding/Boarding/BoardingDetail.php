<?php

namespace App\Livewire\Boarding\Boarding;

use App\Models\StBoardingReading;
use Livewire\Component;

// Livewire Adicionais
use Livewire\Attributes\Session;
use Livewire\WithPagination;
use Livewire\Attributes\On;

// Models
use App\Models\Boarding;
use App\Models\BoardingReading;
use App\Models\Item;
use App\Models\ProfilePermission;
use App\Models\StBoarding;

class BoardingDetail extends Component {

  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $pPage = 10;

  public $boarding, $id, $st = false;

  public $items = [];
  #[Session] public $item;

  // Filters
  #[Session] public $advanced_filters = false;

  public function mount() {
    $this->items = Item::join('boarding_items', 'boarding_items.item_code', '=', 'items.code')->where('boarding_items.boarding_id', $this->id)->get();
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function render() {
    // Caso haja dados selecionados, envia para a tela.
    $this->dispatch('loadDataSelect', ['item' => $this->item]);
    $user = auth()->user();

    $query = BoardingReading::query();
    $stQuery = StBoardingReading::query();

    $this->boarding = Boarding::find($this->id);

    if (!$this->boarding) {
      $this->boarding = StBoarding::find($this->id);
      if (!$this->boarding) {
        return redirect()->route('boar-boardings');
      }

      // Verificar necessidade
      $this->st = true;
    }

    $this->addAdvancedFilters($query, $stQuery);

    if ($this->st) {
      $stQuery->where('boarding_id', $this->id);
      $data['rows'] = $stQuery->paginate($this->pPage);
      return view('livewire.boarding.boarding.boarding-detail', $data);
    }

    $query->where('boarding_id', $this->id);
    $data['rows'] = $query->paginate($this->pPage);
    return view('livewire.boarding.boarding.boarding-detail', $data);
  }

  public function search() {
    $this->advanced_filters = true;
  }

  public function clean() {
    $this->item = null;
    $this->advanced_filters = false;
  }

  public function addAdvancedFilters($query, $stQuery) {
    if ($this->advanced_filters) {
      if ($this->item) {
        $query->where('item_code', $this->item);
        $stQuery->where('item_code', $this->item);
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
    BoardingReading::where('id', $id)->delete();

    $last = BoardingReading::where('boarding_id', $this->id)->first();
    if (!$last) {
      $this->boarding->situation = 2;
      $this->boarding->save();
    }

    return redirect()->route('boar-boarding-detail', $this->id);
  }
}
