@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Hora Máquina')

@section('content')
  <livewire:cultive.machine-hour.machine-hour-create />
@endsection
