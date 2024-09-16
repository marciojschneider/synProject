@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Item')

@section('content')
  <livewire:sys.item.item-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=client]').val(event.detail[0].client);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
