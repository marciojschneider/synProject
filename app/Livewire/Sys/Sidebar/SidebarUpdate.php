<?php

namespace App\Livewire\Sys\Sidebar;

use Livewire\Component;

// Models
use App\Models\Client;
use App\Models\Sidebar;

class SidebarUpdate extends Component {
  // Register
  public $id, $sidebar;

  // 1° Row
  public $name, $icon, $slug, $url;

  // 2° Row
  public $modules = [], $module, $clients = [], $client, $order, $visualization;

  public function mount() {
    $user = auth()->user();
    $this->sidebar = Sidebar::where('id', $this->id)->first();
    if (!$this->sidebar) {
      return redirect()->route('sys-sidebars');
    }

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->get();

    $this->clients = Client::where('situation', 1)
      ->get();

    $this->name = $this->sidebar->name;
    $this->icon = $this->sidebar->icon;
    $this->slug = $this->sidebar->slug;
    $this->url = $this->sidebar->url;
    $this->module = $this->sidebar->affiliate_id;
    $this->client = $this->sidebar->client_id;
    $this->order = $this->sidebar->order;
    $this->visualization = $this->sidebar->visibility;

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['module' => $this->module, 'client' => explode(',', $this->client), 'visualization' => $this->visualization]);
  }

  protected $rules = [
    'name' => 'required',
    'slug' => 'required',
    'module' => 'required',
    'client' => 'required',
    'visualization' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->sidebar->name = $this->name;
    $this->sidebar->icon = $this->icon;
    $this->sidebar->slug = $this->slug;
    $this->sidebar->affiliate_id = $this->module;
    $this->sidebar->url = $this->url;
    $this->sidebar->client_id = is_array($this->client) ? implode(',', $this->client) : $this->client;
    $this->sidebar->order = $this->order;
    $this->sidebar->visibility = $this->visualization;
    $this->sidebar->save();

    return redirect()->route('sys-sidebars');
  }
}
