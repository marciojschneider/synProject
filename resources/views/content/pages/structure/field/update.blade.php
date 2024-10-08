@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Talhão')

@section('content')
  <livewire:structure.field.field-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=locality]').val(event.detail[0].locality);
    $('select[name=farm]').val(event.detail[0].farm);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
