@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Secção')

@section('content')
  <livewire:structure.section.section-create />
@endsection
