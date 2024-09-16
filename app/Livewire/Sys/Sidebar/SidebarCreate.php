<?php

namespace App\Livewire\Sys\Sidebar;

use Livewire\Component;

// Models
use App\Models\Client;
use App\Models\Sidebar;

class SidebarCreate extends Component {
  // 1° Row
  public $name, $icon, $slug, $url;

  // 2° Row
  public $modules = [], $module, $clients = [], $client, $order, $visualization;

  public function mount() {
    $user = auth()->user();

    $this->modules = Sidebar::where('icon', '!=', null)
      ->where('name', '!=', 'Inicio')
      ->get();

    $this->clients = Client::where('situation', 1)
      ->get();
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

    $sidebar = new Sidebar();
    $sidebar->name = $this->name;
    $sidebar->icon = $this->icon ?: null;
    $sidebar->slug = $this->slug;
    $sidebar->affiliate_id = $this->module;
    $sidebar->url = $this->url ?: null;
    $sidebar->client_id = is_array($this->client) ? implode(',', $this->client) : $this->client;
    $sidebar->order = $this->order;
    $sidebar->visibility = $this->visualization;
    $sidebar->save();

    return redirect()->route('sys-sidebars');
  }
}
