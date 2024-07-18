@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil')

@section('content')
  <livewire:sys.profile.profile-update :id="$id" />
@endsection
