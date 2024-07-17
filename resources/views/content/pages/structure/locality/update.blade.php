@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Localidade')

@section('content')
  <livewire:structure.locality.locality-update :id="$id" />
@endsection
