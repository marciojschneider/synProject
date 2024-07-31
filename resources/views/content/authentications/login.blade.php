@php
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Acessar')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            {{-- <div class="app-brand justify-content-center mt-2">
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
                <span class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
                <span class="app-brand-logo demo"><img src="assets/img/kettlow/logotipo-soft-purple-696cff.png" /></span>
              </a>
            </div> --}}
            <!-- /Logo -->
            <h4 class="mb-2">Bem vindo à {{ config('variables.templateName') }}! 👋</h4>
            <p class="mb-4">Informe seus dados para acessar o sistema</p>
            @if (isset($message))
              <p class="alert alert-danger mb-4">{{ $message }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $email ?? '' }}"
                  autofocus>
              </div>
              <div class="mb-3 form-password-toggle">
                <x-authentications.password-input label="Senha" forgot="anything" name="password" id="password" />
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Mantenha-me conectado
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
              </div>
            </form>

            {{-- <p class="text-center">
              <span>Ainda não tem cadastro?</span>
              <a href="{{ route('register') }}">
                <span>Cadastrar-se</span>
              </a>
            </p> --}}
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
  </div>
@endsection
