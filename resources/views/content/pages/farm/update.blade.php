@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Fazenda')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Fazenda</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-farm-update', $farm->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-2">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50"
                value="{{ $farm->code }}" />
            </div>

            <div class="col-md-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50"
                value="{{ $farm->name }}" />
            </div>

            <div class="col-md-2">
              <label for="property" class="form-label">Propriedade</label>
              <select id="property" name="property" class="form-select">
                <option value="0" {{ str_contains($farm->situation, 0) ? 'selected' : '' }}>Terceiro</option>
                <option value="1" {{ str_contains($farm->situation, 1) ? 'selected' : '' }}>Próprio</option>
              </select>
            </div>

            <div class="col-md-3">
              <label for="owner" class="form-label">Proprietário</label>
              <select id="owner" name="owner" class="form-select">
                <option value="1" {{ str_contains($farm->situation, 1) ? 'selected' : '' }}>2 - Granjas Bretanhas
                  S.A.</option>
              </select>
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($farm->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($farm->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-farms') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
