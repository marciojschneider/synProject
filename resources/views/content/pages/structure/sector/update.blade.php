@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Setor')

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
  <livewire:structure.sector.sector-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=farm]').val(event.detail[0].farm);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
