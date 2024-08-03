@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Processo/Etapa')

@section('content')
  <livewire:cultive.process.process-create />
@endsection
