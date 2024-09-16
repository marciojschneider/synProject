@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Item')

@section('content')
  <livewire:sys.item.item-create />
@endsection
