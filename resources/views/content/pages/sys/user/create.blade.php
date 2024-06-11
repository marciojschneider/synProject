@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Usuário')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Usuários /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-user-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" />
            </div>

            <div class="col-md-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" />
            </div>

            <div class="col-md-3">
              <label for="password" class="form-label">Senha</label>
              <input type="text" class="form-control" id="password" name="password" />
            </div>

            <div class="col-md-3">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">Inativo</option>
                <option value="1" selected>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-users') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
