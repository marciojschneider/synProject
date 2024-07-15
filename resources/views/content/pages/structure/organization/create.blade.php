@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Organização')

@section('content')
  <livewire:structure.organization.organization-create />
@endsection
