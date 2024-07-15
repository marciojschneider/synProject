@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Configuração Safra')

@section('content')
  <livewire:harvest.harvest-configuration.harvest-configuration-update :id="$id" />
@endsection
