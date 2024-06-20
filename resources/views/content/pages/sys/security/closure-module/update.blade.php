@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Data de Fechamento')

@section('content')
  <livewire:sys.security.closure-module.closure-module-update :id="$id" />
@endsection
