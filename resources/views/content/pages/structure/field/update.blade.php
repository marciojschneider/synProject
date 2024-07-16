@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Talhão')

@section('content')
  <livewire:structure.field.field-update :id="$id" />
@endsection
