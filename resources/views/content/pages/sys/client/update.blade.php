@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Cliente')

@section('content')
  <livewire:sys.client.client-update :id="$id" />
@endsection
