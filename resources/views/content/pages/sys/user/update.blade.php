@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Usuário')

@section('content')
  <livewire:sys.user.user-update :id="$id" />
@endsection
