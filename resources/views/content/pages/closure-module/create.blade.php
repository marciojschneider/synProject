@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Data de Fechamento')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Sistema / Fechamentos /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-closure-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="sidebar" class="form-label">Módulo</label>
              <select id="sidebar" name="sidebar" class="form-select">
                @foreach ($sidebars as $sidebar)
                  <option value="{{ $sidebar->id }}">{{ $sidebar->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="ending_dt" class="form-label">Fechamento</label>
              <input type="datetime-local" step="1" class="form-control" id="dt_closure" name="dt_closure"
                value="{{ date('Y-m-d', strtotime(now('America/Sao_Paulo'))) }}" />
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">Inativo</option>
                <option value="1" selected>Ativo</option>
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
