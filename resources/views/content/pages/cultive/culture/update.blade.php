@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Cultura')

@section('content')
  <livewire:cultive.culture.culture-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
