@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Safra')

@section('content')
  <livewire:harvest.harvest.harvest-create />
@endsection
