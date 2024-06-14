@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Localidade')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Localidade /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-field-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-3">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50" />
            </div>

            <div class="col-md-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50" />
            </div>

            <div class="col-md-3">
              <label for="farm" class="form-label">Fazenda</label>
              <select id="farm" name="farm" class="form-select">
                @foreach ($farms as $farm)
                  <option value="{{ $farm->id }}"> {{ $farm->name }} </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label for="locality" class="form-label">Localidade</label>
              <select id="locality" name="locality" class="form-select">
                @foreach ($localities as $locality)
                  <option value="{{ $locality->id }}"> {{ $locality->name }} </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-3">
              <label for="total_area" class="form-label">Área Total</label>
              <input type="text" class="form-control" id="total_area" name="total_area" placeholder="0.000,00" />
            </div>

            <div class="col-md-3">
              <label for="productive_area" class="form-label">Área Produtiva</label>
              <input type="text" class="form-control" id="productive_area" name="productive_area"
                placeholder="0.000,00" />
            </div>

            <div class="col-md-2">
              <label for="property_registration" class="form-label">Mátricula</label>
              <input type="text" class="form-control" id="property_registration" name="property_registration"
                maxlength="50" />
            </div>

            <div class="col-md-2">
              <label for="local_group" class="form-label">Grupo</label>
              <input type="text" class="form-control" id="local_group" name="local_group" maxlength="50" />
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">Inativo</option>
                <option value="1" selected>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-fields') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
