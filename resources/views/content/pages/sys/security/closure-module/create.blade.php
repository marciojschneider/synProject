@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Data de Fechamento')

@section('content')
  <livewire:sys.security.closure-module.closure-module-create />
@endsection
