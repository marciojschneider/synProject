@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Cultura')

@section('content')
  <livewire:cultive.culture.culture-create />
@endsection
