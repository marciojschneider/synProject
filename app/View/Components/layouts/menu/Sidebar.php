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
    $data = DB::table('sidebars')->orderBy('order')->orderBy('affiliate_id')->get();

    $array = [];

    foreach ($data as $key => $menu) {
      if (empty($menu->affiliate_id)) {
        $fDataMenu = DB::table('sidebars')->where('affiliate_id', $menu->id)->orderBy('order')->get();
        $array[$key] = ['menu' => ['name' => $menu->name, 'icon' => $menu->icon, 'slug' => $menu->slug, 'url' => $menu->url]];

        foreach ($fDataMenu as $fkey => $fMenu) {
          $array[$key]['menu']['submenu'][] = [
            'name' => $fMenu->name, 'url' => $fMenu->url, 'slug' => $fMenu->slug
          ];

          if (!empty($fMenu->affiliate_id)) {
            $sDataMenu = DB::table('sidebars')->where('affiliate_id', $fMenu->id)->orderBy('order')->get();
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
