@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Secção')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Secções /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-section-update', $section->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-6">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" value="{{ $section->code }}" />
            </div>

            <div class="col-md-6">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $section->name }}" />
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="organization" class="form-label">Organização</label>
              <select id="organization" name="organization" class="form-select">
                @foreach ($orgs as $org)
                  <option value="{{ $org->id }}"
                    {{ str_contains($section->organization_id, $org->id) ? 'selected' : '' }}> {{ $org->code }} -
                    {{ $org->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="responsible" class="form-label">Responsável</label>
              <select id="responsible" name="responsible" class="form-select">
                <option value="8" {{ str_contains($section->responsible, 8) ? 'selected' : '' }}>
                  2 - Granja Bretanhas S.A.
                </option>
                <option value="130" {{ str_contains($section->responsible, 130) ? 'selected' : '' }}>
                  6157 - ADELSON CESAR PORTO CARDOSO
                </option>
                <option value="154" {{ str_contains($section->responsible, 154) ? 'selected' : '' }}>
                  6082 - JAQUES LAGES DUTRA
                </option>
                <option value="158" {{ str_contains($section->responsiblen, 158) ? 'selected' : '' }}>
                  6044 - JOSE PAULO LIMA
                </option>
              </select>
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($section->situation, 0) ? 'selected' : '' }}>INATIVO</option>
                <option value="1" {{ str_contains($section->situation, 1) ? 'selected' : '' }}>ATIVO</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-sections') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
