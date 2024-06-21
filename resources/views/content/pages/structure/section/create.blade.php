@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Secção')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Secções /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-section-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-6">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50" />
            </div>

            <div class="col-md-6">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50" />
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="organization" class="form-label">Organização</label>
              <select id="organization" name="organization" class="form-select">
                @foreach ($orgs as $org)
                  <option value="{{ $org->id }}"> {{ $org->code }} - {{ $org->name }} </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="responsible" class="form-label">Responsável</label>
              <select id="responsible" name="responsible" class="form-select">
                <option value="8">2 - GRANJA BRETANHAS S.A.</option>
                <option value="130">6157 - ADELSON CESAR PORTO CARDOSO</option>
                <option value="154">6082 - JAQUES LAGES DUTRA</option>
                <option value="158">6044 - JOSE PAULO LIMA</option>
              </select>
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">INATIVO</option>
                <option value="1" selected>ATIVO</option>
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
