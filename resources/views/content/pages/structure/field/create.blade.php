@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Talhão')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/forms-selects.js'])
@endsection

@section('content')
  <livewire:structure.field.field-create />
@endsection
