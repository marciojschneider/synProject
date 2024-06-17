@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Configuração Safra')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Configuração Safra /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('harv-configuration-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-2">
              <label for="harvest" class="form-label">Safra</label>
              <select id="harvest" name="harvest" class="form-select">
                @foreach ($harvests as $harvest)
                  <option value="{{ $harvest->id }}">{{ $harvest->code }} - {{ $harvest->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="section" class="form-label">Secção</label>
              <select id="section" name="section" class="form-select">
                @foreach ($sections as $section)
                  <option value="{{ $section->id }}">{{ $section->code }} - {{ $section->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="field" class="form-label">Talhão</label>
              <select id="field" name="field" class="form-select">
                @foreach ($fields as $field)
                  <option value="{{ $field->id }}">{{ $field->code }} - {{ $field->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="culture" class="form-label">Cultura</label>
              <select id="culture" name="culture" class="form-select">
                @foreach ($cultures as $culture)
                  <option value="{{ $culture->id }}">{{ $culture->code }} - {{ $culture->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="variety" class="form-label">Variedade</label>
              <select id="variety" name="variety" class="form-select">
                @foreach ($varieties as $variety)
                  <option value="{{ $variety->id }}">{{ $variety->code }} - {{ $variety->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="planting_method" class="form-label">Método Plantio</label>
              <select id="planting_method" name="planting_method" class="form-select">
                @foreach ($planting_methods as $planting_method)
                  <option value="{{ $planting_method->id }}">{{ $planting_method->code }} -
                    {{ $planting_method->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="planting_area" class="form-label">Área Plantio</label>
              <input type="text" class="form-control" id="planting_area" name="planting_area" placeholder="0.000,00" />
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">FECHADO</option>
                <option value="1" selected>ABERTO</option>
              </select>
            </div>

            <div class="col-md-4">
              <label for="organization" class="form-label">Estabelecimento</label>
              <select id="organization" name="organization" class="form-select">
                @foreach ($organizations as $organization)
                  <option value="{{ $organization->id }}">{{ $organization->code }} - {{ $organization->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('harv-configurations') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
