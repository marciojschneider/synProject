@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Atualizar Fazenda')

@section('content')
  <livewire:structure.farm.farm-update :id="$id" />
@endsection
