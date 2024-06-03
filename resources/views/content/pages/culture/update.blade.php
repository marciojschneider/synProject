@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Cultura')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Cultura /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('structure-culture-update', $culture->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-6">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50"
                value="{{ $culture->code }}" />
            </div>

            <div class="col-md-6">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50"
                value="{{ $culture->name }}" />
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('structure-cultures') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
