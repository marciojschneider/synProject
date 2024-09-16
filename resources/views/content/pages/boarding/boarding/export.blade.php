@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Exportação')

@section('content')
  <livewire:boarding.boarding.boarding-export />
@endsection
