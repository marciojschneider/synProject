@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Perfis')

@section('content')
  <livewire:profile-list />
@endsection
