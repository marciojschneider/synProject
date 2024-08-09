@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Processo/Etapa')

@section('content')
  <livewire:cultive.process.process-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=type]').val(event.detail[0].type);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
