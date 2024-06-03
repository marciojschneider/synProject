@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Safra')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Safra /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-harvest-update', $harvest->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50"
                value="{{ $harvest->code }}" />
            </div>

            <div class="col-md-4">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50"
                value='{{ $harvest->name }}' />
            </div>

            <div class="col-md-4">
              <label for="price_table" class="form-label">Preço</label>
              <select id="price_table" name="price_table" class="form-select">
                <option value="0" {{ str_contains($harvest->code, 0) ? 'selected' : '' }}>Fictício</option>
              </select>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="initial_dt" class="form-label">Início</label>
              <input type="datetime-local" step="1" class="form-control" id="initial_dt" name="initial_dt"
                value="{{ $harvest->initial_dt }}" />
            </div>

            <div class="col-md-4">
              <label for="ending_dt" class="form-label">Fim</label>
              <input type="datetime-local" step="1" class="form-control" id="ending_dt" name="ending_dt"
                value="{{ $harvest->ending_dt }}" />
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($harvest->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($harvest->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-harvests') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
