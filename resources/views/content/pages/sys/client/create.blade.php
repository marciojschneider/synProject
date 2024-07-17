@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Cliente')

@section('content')
  <livewire:sys.client.client-create />
@endsection
