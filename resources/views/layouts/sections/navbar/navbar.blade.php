@php
  $containerNav = $containerNav ?? 'container-fluid';
  $navbarDetached = $navbarDetached ?? '';

@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav
    class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
    id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
  <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
    <a href="{{ url('/') }}" class="app-brand-link gap-2">
      {{-- <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span> --}}
      <span class="app-brand-logo demo"><img src="{{ asset('assets/img/synergya/sidebar.png') }}" /></span>
      <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.templateName') }}</span>
    </a>

    @if (isset($menuHorizontal))
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    @endif
  </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
  <div
    class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

  @if ($configData['hasCustomizer'] == true)
    <!-- Style Switcher -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <i class='bx bx-sm'></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
              <span class="align-middle"><i class='bx bx-sun me-2'></i>Light</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
              <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
              <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!--/ Style Switcher -->
  @endif

  <ul class="navbar-nav flex-row align-items-center ms-auto">

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3" style="padding-top: 8%">
                <div class="avatar avatar-online">
                  <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                </div>
              </div>
              <div class="flex-grow-1">
                @if (Auth::check())
                  <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                  <span class="fw-small">{{ Auth::user()->client->name }}</span></br>
                  <small class="text-muted">{{ Auth::user()->profile->name }}</small>
                @else
                  {{ Auth::logout() }}
                  {{ redirect()->route('login') }}
                @endif
              </div>
            </div>
          </a>
        </li>
        @if (count(Auth::user()->cClients) >= 2 || count(Auth::user()->cProfiles) >= 2)
          <li>
            <div class="dropdown-divider"></div>
          </li>
        @endif
        @if (count(Auth::user()->cClients) >= 2)
          <li>
            <a class="dropdown-item" href="{{ route('select-client') }}">
              <i class="bx bx-buildings me-2"></i>
              <span class="align-middle">Trocar Organização</span>
            </a>
          </li>
        @endif
        @if (count(Auth::user()->cProfiles) >= 2)
          <li>
            <a class="dropdown-item" href="{{ route('select-profile') }}">
              <i class='bx bx-briefcase-alt-2 me-2'></i>
              <span class="align-middle">Trocar Perfil</span>
            </a>
          </li>
        @endif
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('exit') }}">
            <i class='bx bx-power-off me-2'></i>
            <span class="align-middle">Sair</span>
          </a>
        </li>
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>

@if (!isset($navbarDetached))
  </div>
@endif
</nav>
<!-- / Navbar -->
