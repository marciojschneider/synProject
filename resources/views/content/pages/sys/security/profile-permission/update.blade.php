@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Permissão')

@section('content')
  <livewire:sys.security.profile-permission.profile-permission-update :id="$id" />
@endsection
