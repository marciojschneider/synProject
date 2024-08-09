@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Configuração Safra')

@section('content')
  <livewire:harvest.harvest-configuration.harvest-configuration-create />
@endsection
