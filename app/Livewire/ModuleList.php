<?php

namespace App\Livewire;

use Livewire\Component;

// Livewire adicionais
use Livewire\WithPagination;

// Models
use App\Models\Module;

class ModuleList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $searchText;
  public $pPage = 10;

  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $query = Module::query();

    if ($this->searchText) {
      $query->where('name', 'like', '%' . $this->searchText . '%');
      $query->orWhere('description', 'like', '%' . $this->searchText . '%');
    }

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.module-list', $data);
  }
}
