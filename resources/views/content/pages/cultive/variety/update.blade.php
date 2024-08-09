@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Variedade')

@section('content')
  <livewire:cultive.variety.variety-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=culture]').val(event.detail[0].culture);
    $('select[name=group]').val(event.detail[0].group);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
