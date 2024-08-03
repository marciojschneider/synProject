@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Método Plantio')

@section('content')
  <livewire:cultive.planting-method.planting-method-create />
@endsection
