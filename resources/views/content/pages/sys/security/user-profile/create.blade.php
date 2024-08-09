@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Perfil de Usuário')

@section('content')
  <livewire:sys.security.user-profile.user-profile-create />
@endsection
