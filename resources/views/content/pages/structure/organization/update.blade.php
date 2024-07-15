@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Organização')

@section('content')
  <livewire:structure.organization.organization-update :id="$id" />
@endsection
