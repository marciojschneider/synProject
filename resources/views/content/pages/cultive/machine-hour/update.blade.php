@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Hora Máquina')

@section('content')
  <livewire:cultive.machine-hour.machine-hour-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=field]').val(event.detail[0].field);
    $('select[name=type]').val(event.detail[0].type);
    $('select[name=operator]').val(event.detail[0].operator);
    $('select[name=process]').val(event.detail[0].process);
    $('select[name=planting_method]').val(event.detail[0].planting_method);
    $('select[name=variety]').val(event.detail[0].variety);
    $('select[name=equipament]').val(event.detail[0].equipament);
    $('select[name=implement]').val(event.detail[0].implement);
    $('select[name=stop_reason]').val(event.detail[0].stop_reason);
  })
</script>
