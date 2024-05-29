@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo chamado')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Chamados /</span> {{ $condition }}
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <input type="hidden" value="{{ isset($task) ? $task : null }}" id="task">
      <div class="card-body">
        <form method="POST" action="{{ route(isset($formRoute) ? $formRoute : 'sup-task-update', isset($task->id)) }}">
          @csrf
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="name" class="form-label">Título</label>
              <input type="text" class="form-control" id="title" name="title" maxlength="50"
                value="{{ isset($task->title) }}" />
            </div>

            <div class="col-md-2">
              <label for="module" class="form-label">Módulo</label>
              <select id="module" name="module" class="form-select">
                @foreach ($modules as $module)
                  @if (isset($task->module_id))
                    @if ($module->id === $task->module_id)
                      <option value="{{ $module->id }}" selected>{{ $module->name }}</option>
                    @else
                      <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="1" {{ (isset($task->situation) ? $task->situation : null === 1) ? 'selected' : '' }}>
                  Solicitado</option>
                <option value="2" {{ (isset($task->situation) ? $task->situation : null === 2) ? 'selected' : '' }}>
                  Em
                  desenvolvimento</option>
                <option value="3" {{ (isset($task->situation) ? $task->situation : null === 3) ? 'selected' : '' }}>
                  Pendente</option>
                <option value="4" {{ (isset($task->situation) ? $task->situation : null === 4) ? 'selected' : '' }}>
                  Aprovado</option>
                <option value="5" {{ (isset($task->situation) ? $task->situation : null === 5) ? 'selected' : '' }}>
                  Inativo</option>
              </select>
            </div>

            <div class="col-md-2">
              <label for="solicitation" class="form-label">Solicitação</label>
              <input class="form-control" type="datetime-local" step="1"
                value="{{ isset($task->initial_dt) ? $task->initial_dt : '' }}" id="solicitation" name="solicitation"
                onchange="updateData()" />
            </div>

            <div class="col-md-2">
              <label for="expectation" class="form-label">Expectativa</label>
              <input class="form-control" type="datetime-local" step="1"
                value="{{ isset($task->expected_dt) ? $task->expected_dt : '' }}" {{ $readonly }} id="expectation"
                name="expectation" />
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-12">
              <label for="defaultSelect" class="form-label">Descrição</label>
              <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
                name="description" maxlength="250" rows="4"> {{ isset($task->description) ? $task->description : '' }} </textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a onclick="getTask()" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
