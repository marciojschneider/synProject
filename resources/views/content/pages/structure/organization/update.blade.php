@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Organização')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Organizações /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-organization-update', $organization->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-3">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50"
                value="{{ $organization->code }}" />
            </div>

            <div class="col-md-3">
              <label for="external_code" class="form-label">Código Externo</label>
              <input type="text" class="form-control" id="external_code" name="external_code" maxlength="50"
                value="{{ $organization->external_code }}" />
            </div>

            <div class="col-md-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50"
                value="{{ $organization->name }}" />
            </div>

            <div class="col-md-3">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($organization->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($organization->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-2">
              <label for="machine_hour_dt" class="form-label">Hora Máquina</label>
              <input type="datetime-local" step="1" class="form-control" id="machine_hour_dt" name="machine_hour_dt"
                value="{{ $organization->machine_hour_dt }}" />
            </div>

            <div class="col-md-2">
              <label for="ordinance_dt" class="form-label">Portaria</label>
              <input type="datetime-local" step="1" class="form-control" id="ordinance_dt" name="ordinance_dt"
                value="{{ $organization->ordinance_dt }}" />
            </div>

            <div class="col-md-2">
              <label for="maintenance_dt" class="form-label">Manutenção</label>
              <input type="datetime-local" step="1" class="form-control" id="maintenance_dt" name="maintenance_dt"
                value="{{ $organization->maintenance_dt }}" />
            </div>

            <div class="col-md-2">
              <label for="fuel_dt" class="form-label">Gasolina</label>
              <input type="datetime-local" step="1" class="form-control" id="fuel_dt" name="fuel_dt"
                value="{{ $organization->fuel_dt }}" />
            </div>

            <div class="col-md-2">
              <label for="harvest_dt" class="form-label">Colheita</label>
              <input type="datetime-local" step="1" class="form-control" id="harvest_dt" name="harvest_dt"
                value="{{ $organization->harvest_dt }}" />
            </div>

            <div class="col-md-2">
              <label for="inputs_dt" class="form-label">Insumos</label>
              <input type="datetime-local" step="1" class="form-control" id="inputs_dt" name="inputs_dt"
                value="{{ $organization->inputs_dt }}" />
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-organizations') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
