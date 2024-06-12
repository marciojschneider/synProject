@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil de Usuário')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Sistema / Perfil de Usuários /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-sec-user-profile-update', $userProfile->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-4">
              <label for="sidebar" class="form-label">Usuário</label>
              <select id="sidebar" name="sidebar" class="form-select">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}"
                    {{ str_contains($userProfile->user_id, $user->id) ? 'selected' : '' }}>{{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="profile" class="form-label">Perfil</label>
              <select id="profile" name="profile" class="form-select">
                @foreach ($profiles as $profile)
                  <option value="{{ $profile->id }}"
                    {{ str_contains($userProfile->profile_id, $profile->id) ? 'selected' : '' }}>{{ $profile->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($userProfile->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($userProfile->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-sec-permissions') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
