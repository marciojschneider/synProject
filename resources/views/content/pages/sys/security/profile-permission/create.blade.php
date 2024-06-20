@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Permissão')

@section('content')
  <livewire:sys.security.profile-permission.profile-permission-create />
@endsection
