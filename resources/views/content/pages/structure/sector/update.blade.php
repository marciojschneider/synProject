@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Setor')

@section('content')
  <livewire:structure.sector.sector-update :id="$id" />
@endsection
