@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Embarque')

@section('content')
  <livewire:boarding.boarding.boarding-update :id="$id" />
@endsection
