@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Método Plantio')

@section('content')
  <livewire:cultive.planting-method.planting-method-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
