@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Cliente')

@section('content')
  <livewire:sys.client.client-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
