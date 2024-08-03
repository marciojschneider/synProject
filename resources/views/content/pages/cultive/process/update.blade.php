@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Processo/Etapa')

@section('content')
  <livewire:cultive.process.process-update :id="$id" />
@endsection
