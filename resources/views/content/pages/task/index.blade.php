@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Tarefas')

@section('content')
  <h4 class="mb-0">
    Tarefas
  </h4>

  <!-- Add Collumn -->
  <div class="d-flex flex-wrap justify-content-between align-items-center">
    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Adicionar uma tarefa</h4>
      <p class="text-muted">Tarefas serão feitas conforme a data da adesão e o grau de urgência definidos no sistema.</p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">{{-- Botão de novo usuário --}}
      <div class="dt-buttons" bis_skin_checked="1">
        <a class="dt-button add-new btn btn-primary" href="#"><span> <i class="bx bx-plus me-0 me-sm-1"></i><span
              class="d-none d-sm-inline-block">Nova</span>
          </span>
        </a>
      </div>
    </div>
  </div>
@endsection
