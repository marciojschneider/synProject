@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo chamado')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Clientes /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-client-update', $client->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-2">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" value="{{ $client->code }}"
                maxlength="10" />
            </div>

            <div class="col-md-4">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}"
                maxlength="50" />
            </div>

            <div class="col-md-4">
              <label for="url" class="form-label">URL</label>
              <input type="text" class="form-control" id="url" name="url" value="{{ $client->url }}"
                maxlength="250" />
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($client->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($client->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-clients') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
