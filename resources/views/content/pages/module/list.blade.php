@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Módulos')

@section('content')
  <livewire:module-list />
@endsection
