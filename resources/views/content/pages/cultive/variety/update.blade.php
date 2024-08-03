@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Variedade')

@section('content')
  <livewire:cultive.variety.variety-update :id="$id" />
@endsection
