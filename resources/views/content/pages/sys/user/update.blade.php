@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Usuário')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Usuários /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-user-update', $user->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ $user->name }}" readonly />
              @error('name')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" value="{{ $user->email }}" readonly />
              @error('email')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="password" class="form-label">Senha</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" />
              @error('password')
                <div class="invalid-feedback"> {{ $message }} </div>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($user->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($user->situation, 1) ? 'selected' : '' }}>Ativo</option>
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
