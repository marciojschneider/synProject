@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil')

@section('content')
  <livewire:sys.profile.profile-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=client]').val(event.detail[0].client);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
