@php
  $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <!-- ! Hide app brand if navbar-full -->
  @if (!isset($navbarFull))
    <div class="app-brand demo">
      <a href="{{ url('/') }}" class="app-brand-link">
        <span class="app-brand-logo demo pb-2">
          {{-- @include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)']) --}}
          <img src="{{ asset('assets/img/synergya/sidebar.png') }}" style="width: 30px" />
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2 pb-1"
          style="text-transform: uppercase !important; padding-left: 5%">{{ config('variables.templateName') }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>
  @endif

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    {{-- {{ dd($dataMenu) }} --}}
    @foreach ($dataMenu as $key => $menu)
      {{-- adding active and open class if child is active --}}

      {{-- menu headers --}}
      @if (isset($menu['menu']['header']))
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">{{ __($menu['menu']['header']) }}</span>
        </li>
      @else
        {{-- active menu method --}}
        @php
          $activeClass = null;
          $active = 'active open';
          $currentRouteName = Route::currentRouteName();

          if ($currentRouteName === $menu['menu']['slug']) {
              $activeClass = 'active';
          } elseif (isset($menu['menu']['submenu'])) {
              if (gettype($menu['menu']['slug']) === 'array') {
                  foreach ($menu['menu']['slug'] as $slug) {
                      if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                          $activeClass = $active;
                      }
                  }
              } else {
                  if (
                      str_contains($currentRouteName, $menu['menu']['slug']) and
                      strpos($currentRouteName, $menu['menu']['slug']) === 0
                  ) {
                      $activeClass = $active;
                  }
              }
          }
        @endphp

        {{-- main menu --}}
        <li class="menu-item {{ $activeClass }}">
          <a href="{{ isset($menu['menu']['url']) ? url($menu['menu']['url']) : 'javascript:void(0);' }}"
            class="{{ isset($menu['menu']['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}"
            @if (isset($menu['menu']['target']) and !empty($menu['menu']['target'])) target="_blank" @endif>
            @isset($menu['menu']['icon'])
              <i class="{{ $menu['menu']['icon'] }}"></i>
            @endisset
            <div>{{ isset($menu['menu']['name']) ? __($menu['menu']['name']) : '' }}</div>
            {{-- @isset($menu['menu']->badge)
                <div class="badge bg-{{ $menu['menu']->badge[0] }} rounded-pill ms-auto">{{ $menu['menu']->badge[1] }}</div>
            @endisset --}}
          </a>

          {{-- submenu --}}
          @isset($menu['menu']['submenu'])
            @include('layouts.sections.menu.submenu', ['menu' => $menu['menu']['submenu']])
          @endisset
        </li>
      @endif
    @endforeach
  </ul>

</aside>
