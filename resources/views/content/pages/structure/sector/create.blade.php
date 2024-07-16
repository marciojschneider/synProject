@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Setor')

@section('content')
  <livewire:structure.sector.sector-create />
@endsection
