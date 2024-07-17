@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Localidade')

@section('content')
  <livewire:structure.locality.locality-create />
@endsection
