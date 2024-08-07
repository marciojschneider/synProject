@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Localidade')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/forms-selects.js'])
@endsection

@section('content')
  <livewire:structure.locality.locality-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
