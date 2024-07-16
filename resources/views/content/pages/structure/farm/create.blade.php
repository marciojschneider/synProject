@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Fazenda')

@section('content')
  <livewire:structure.farm.farm-create />
@endsection
