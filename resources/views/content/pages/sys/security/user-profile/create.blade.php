@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo Perfil de Usuário')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Sistema / Perfil de Usuários /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-sec-user-profile-create') }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="user" class="form-label">Usuário</label>
              <select id="user" name="user" class="form-select">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="profile" class="form-label">Perfil</label>
              <select id="profile" name="profile" class="form-select">
                @foreach ($profiles as $profile)
                  <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0">Inativo</option>
                <option value="1" selected>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-sec-user-profiles') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
