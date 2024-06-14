@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Fazenda')

{{-- Verificar estilizações necessárias para o funcionamento da pagina --}}
@section('vendor-style')
  @vite(['resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/plyr/plyr.scss'])
@endsection

@section('page-style')
  @vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/plyr/plyr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/extended-ui-sweetalert2.js', 'resources/assets/js/app-academy-course-details.js'])
@endsection

@section('content')
  <livewire:section-list />
@endsection
