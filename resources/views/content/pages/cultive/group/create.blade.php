@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Grupo')

@section('content')
  <livewire:cultive.group.group-create />
@endsection
