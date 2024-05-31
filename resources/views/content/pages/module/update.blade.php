@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Módulo')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Módulos /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sys-module-update', $module->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-4">
              <div class="col-md-12">
                <label for="sidebar" class="form-label">Módulo</label>
                <select id="sidebar" name="sidebar" class="form-select" disabled>
                  @foreach ($sidebars as $sidebar)
                    <option value="{{ $sidebar->id }}"
                      {{ str_contains($module->slug, $sidebar->slug) ? 'selected' : '' }}>
                      {{ $sidebar->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12">
                <label for="profile" class="form-label">Perfis</label>
                <select id="profile" name="profile" class="form-select">
                  @foreach ($profiles as $profile)
                    <option value="{{ $profile->id }}"
                      {{ str_contains($permissions->profile_id, $profile->id) ? 'selected' : '' }}>{{ $profile->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-8">
              <label for="description" class="form-label">Descrição</label>
              <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
                name="description" maxlength="250" rows="4"> {{ $module->description }} </textarea>
            </div>
          </div>

          <!-- Permission table -->
          <div class="row mb-4">
            <div class="d-flex justify-content-between">
              <span class="text-nowrap fw-medium">Permissões <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                  data-bs-placement="top" title="Selecione as permissões do perfil diante ao módulo"></i>
              </span>

              <div class="form-check ">
                <input class="form-check-input" type="checkbox" name="listCheck"
                  {{ $permissions->list == 1 ? 'checked' : '' }} />
                <label class="form-check-label" for="listCheck">
                  Listagem
                </label>
              </div>

              <div class="form-check ">
                <input class="form-check-input" type="checkbox" name="createCheck"
                  {{ $permissions->create == 1 ? 'checked' : '' }} />
                <label class="form-check-label" for="createCheck">
                  Criação
                </label>
              </div>

              <div class="form-check ">
                <input class="form-check-input" type="checkbox" name="updateCheck"
                  {{ $permissions->update == 1 ? 'checked' : '' }} />
                <label class="form-check-label" for="updateCheck">
                  Edição
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="deleteCheck"
                  {{ $permissions->delete == 1 ? 'checked' : '' }} />
                <label class="form-check-label" for="deleteCheck">
                  Remoção
                </label>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-modules') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
