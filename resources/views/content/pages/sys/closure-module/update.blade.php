@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Data de Fechamento')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Sistema / Fechamentos /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-closure-update', $closure_module->id) }}">
          @csrf
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="sidebar" class="form-label">Módulo</label>
              <select id="sidebar" name="sidebar" class="form-select">
                @foreach ($sidebars as $sidebar)
                  <option value="{{ $sidebar->id }}"
                    {{ str_contains($closure_module->sidebar_id, $sidebar->id) ? 'selected' : '' }}>{{ $sidebar->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="dt_closure" class="form-label">Fechamento</label>
              <input type="datetime-local" step="1" class="form-control" id="dt_closure" name="dt_closure"
                value="{{ $closure_module->dt_closure }}" />
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($closure_module->situation, 0) ? 'selected' : '' }}>Inativo
                </option>
                <option value="1" {{ str_contains($closure_module->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-closures') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
