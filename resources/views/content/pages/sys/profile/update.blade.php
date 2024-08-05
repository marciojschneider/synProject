@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil')

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
  <livewire:sys.profile.profile-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=client]').val(event.detail[0].client);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
