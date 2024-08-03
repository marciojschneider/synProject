@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Método Plantio')

@section('content')
  <livewire:cultive.planting-method.planting-method-update :id="$id" />
@endsection
