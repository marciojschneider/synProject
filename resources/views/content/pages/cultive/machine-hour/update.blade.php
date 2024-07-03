@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Hora Máquina')

@section('content')
  <livewire:cultive.machine-hour.machine-hour-update :id="$id" />
@endsection
