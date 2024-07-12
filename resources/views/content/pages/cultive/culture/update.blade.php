@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Cultura')

@section('content')
  <livewire:cultive.group.group-update :id="$id" />
@endsection
