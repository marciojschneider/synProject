@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Embarque')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/extended-ui-sweetalert2.js'])
@endsection

@section('content')
  <livewire:boarding.boarding.boarding-list />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=separadores]').val(event.detail[0].separadores)
    $('select[name=situation]').val(event.detail[0].situation)
  })

  // Necessário para a renderização correta do multiple
  $('#situation').selectpicker('destroy')
  $('#situation').selectpicker()

  function cleanFilters() {
    $('#separadores').selectpicker('val', null)
    $('#situation').selectpicker('val', ['1', '2'])
  }
</script>
