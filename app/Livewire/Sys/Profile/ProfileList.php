<?php

namespace App\Livewire\Sys\Profile;

use Livewire\Component;

// Livewire Adicionais
use Livewire\WithPagination;

// Models
use App\Models\Profile;
use App\Models\Client;

class ProfileList extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variaveis
  public $searchText;
  public $pPage = 10;
  public $clients;
  public $client;

  public function mount() {
  }

  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();
    $query = Profile::query();

    $query->join('clients', 'clients.id', '=', 'profiles.client_id');

    if ($this->searchText) {
      $query->where('profiles.name', 'like', '%' . $this->searchText . '%');
    }

    if ($this->client) {
      $query->where('client_id', $this->client);
    }

    $query->where('clients.id', $user->in_client);

    $query->select('profiles.*', 'clients.name as cName')->get();

    $data['rows'] = $query->paginate($this->pPage);

    return view('livewire.sys.profile.profile-list', $data);
  }
}
