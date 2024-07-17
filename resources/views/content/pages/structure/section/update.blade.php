@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Secção')

@section('content')
  <livewire:structure.section.section-update :id="$id" />
@endsection
