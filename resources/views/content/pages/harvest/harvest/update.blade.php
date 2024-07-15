@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Safra')

@section('content')
  <livewire:harvest.harvest.harvest-update :id="$id" />
@endsection
