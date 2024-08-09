@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Talhão')

@section('content')
  <livewire:structure.field.field-create />
@endsection
