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
      <div class="card-body">
        <form method="POST" action="#">
          @csrf
          <div class="row mb-4">
            <div class="col-md-3">
              <label for="name" class="form-label">Título</label>
              <input type="text" class="form-control" id="title" name="title" />
            </div>

            <div class="col-md-3">
              <label for="module" class="form-label">Módulo</label>
              <select id="module" name="module" class="form-select">
              </select>
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="1">Solicitado</option>
                <option value="1">Em desenvolvimento</option>
                <option value="1">Pendente</option>
                <option value="1">Aprovado</option>
                <option value="1">Inativo</option>
              </select>
            </div>

            <div class="col-md-2">
              <label for="solicitation" class="form-label">Solicitação</label>
              <input class="form-control" type="datetime-local" step="1"
                value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="solicitation"
                name="solicitation" />
            </div>

            <div class="col-md-2">
              <label for="expectation" class="form-label">Expectativa</label>
              <input class="form-control" type="datetime-local" step="1"
                value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="expectation"
                name="expectation" />
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-12">
              <label for="defaultSelect" class="form-label">Descrição</label>
              <textarea rows="4" class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão."
                id="description" name="description"></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sup-tasks') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
