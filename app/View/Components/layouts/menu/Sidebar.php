<?php

namespace App\View\Components\layouts\menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// Importações adicionais
use Illuminate\Support\Facades\DB;

class Sidebar extends Component {

  public $dataMenu;

  public function __construct() {
    $user = auth()->user();
    $data = DB::table('profile_permissions')
      ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
      ->where('profile_permissions.profile_id', $user->in_profile)
      ->where('profile_permissions.client_id', $user->in_client)
      ->where('profile_permissions.view', 1)
      ->where('profile_permissions.situation', 1)
      ->where('sidebars.visibility', 1)
      ->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
      ->orderBy('order')->orderBy('sidebars.affiliate_id')->get();

    $array = [];

    foreach ($data as $key => $menu) {
      if (empty($menu->affiliate_id)) {
        $fDataMenu = DB::table('profile_permissions')
          ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
          ->where('sidebars.affiliate_id', $menu->id)
          ->where('profile_permissions.profile_id', $user->in_profile)
          ->where('profile_permissions.client_id', $user->in_client)
          ->where('profile_permissions.view', 1)
          ->where('profile_permissions.situation', 1)
          ->where('sidebars.visibility', 1)
          ->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
          ->orderBy('order')->get();
        $array[$key] = ['menu' => ['name' => $menu->name, 'icon' => $menu->icon, 'slug' => $menu->slug, 'url' => $menu->url]];

        foreach ($fDataMenu as $fkey => $fMenu) {
          $array[$key]['menu']['submenu'][] = [
            'name' => $fMenu->name, 'url' => $fMenu->url, 'slug' => $fMenu->slug
          ];

          if (!empty($fMenu->affiliate_id)) {
            $sDataMenu = DB::table('profile_permissions')
              ->where('sidebars.client_id', 'REGEXP', '[[:<:]]' . $user->in_client . '[[:>:]]')
              ->where('sidebars.affiliate_id', $fMenu->id)
              ->where('profile_permissions.profile_id', $user->in_profile)
              ->where('profile_permissions.client_id', $user->in_client)
              ->where('profile_permissions.view', 1)
              ->where('sidebars.visibility', 1)
              ->join('sidebars', 'sidebars.id', '=', 'profile_permissions.sidebar_id')
              ->orderBy('order')->get();
            foreach ($sDataMenu as $sMenu) {
              $array[$key]['menu']['submenu'][$fkey]['submenu'][] = [
                'name' => $sMenu->name, 'url' => $sMenu->url, 'slug' => $sMenu->slug
              ];
            }
          }
        }
      }
    }

    $this->dataMenu = $array;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string {
    return view('components.layouts.menu.sidebar');
  }
}
