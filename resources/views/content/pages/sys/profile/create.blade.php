@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Perfil')

@section('content')
  <livewire:sys.profile.profile-create />
@endsection
