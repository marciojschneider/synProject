@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil de Usuário')

@section('content')
  <livewire:sys.security.user-profile.user-profile-update :id="$id" />
@endsection
