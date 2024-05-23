@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Inicio')

@section('content')
  <h4>Inicio</h4>

  <p>Precisa de referencia? Busque aqui:
    <a href="{{ config('variables.documentation') ? config('variables.documentation') . '/laravel-introduction.html' : '#' }}"
      target="_blank" rel="noopener noreferrer">documentação
    </a>
    .
  </p>
@endsection
