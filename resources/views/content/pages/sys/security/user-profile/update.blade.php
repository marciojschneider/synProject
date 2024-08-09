@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil de Usuário')

@section('content')
  <livewire:sys.security.user-profile.user-profile-update :id="$id" />
@endsection

<script>
  window.addEventListener('loadDataSelect', event => {
    $('select[name=user]').val(event.detail[0].user);
    $('select[name=profile]').val(event.detail[0].profile);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
