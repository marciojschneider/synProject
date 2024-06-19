@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Sem permissão')

@section('page-style')
  <!-- Page -->
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection

@section('content')
  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Acesso negado!</h2>
      <p class="mb-4 mx-2">Oops! 😖 Parece que você está tentando acessar uma página que não tem permissão.</p>
      <a href="{{ route('homepage') }}" class="btn btn-primary">Voltar para o inicio</a>
      <div class="mt-3">
        <img src="{{ asset('assets/img/illustrations/page-misc-error-' . $configData['style'] . '.png') }}"
          alt="page-misc-error-light" width="500" class="img-fluid"
          data-app-dark-img="illustrations/page-misc-error-dark.png"
          data-app-light-img="illustrations/page-misc-error-light.png">
      </div>
    </div>
  </div>
  <!-- /Error -->
@endsection
