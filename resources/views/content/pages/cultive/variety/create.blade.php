@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Variedade')

@section('content')
  <livewire:cultive.variety.variety-create />
@endsection
