@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Usuário')

@section('content')
  <livewire:sys.user.user-create />
@endsection
