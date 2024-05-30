@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo chamado')

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Módulos /</span> Cadastrar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sup-task-create') }}">
          @csrf
          <div class="row mb-4">
            <div class="col-sm-4">
              <div class="col-md-12">
                <label for="module" class="form-label">Módulo</label>
                <select id="module" name="module" class="form-select">
                  @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12">
                <label for="situation" class="form-label">Perfis</label>
                <select id="situation" name="situation" class="form-select">
                  <option value="1">Teste</option>
                </select>
              </div>
            </div>

            <div class="col-sm-8">
              <label for="defaultSelect" class="form-label">Descrição</label>
              <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
                name="description" maxlength="250" rows="4"></textarea>
            </div>
          </div>

          <form id="addRoleForm" class="row g-3" onsubmit="return false">
            <!-- Permission table -->
            <div class="row mb-4">
              <div class="d-flex justify-content-between">
                <span class="text-nowrap fw-medium">Permissões <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Selecione as permissões do perfil diante ao módulo"></i>
                </span>

                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="payrollRead" />
                  <label class="form-check-label" for="payrollRead">
                    Listagem
                  </label>
                </div>

                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="payrollWrite" />
                  <label class="form-check-label" for="payrollWrite">
                    Gravação
                  </label>
                </div>

                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" id="payrollCreate" />
                  <label class="form-check-label" for="payrollCreate">
                    Edição
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="payrollCreate" />
                  <label class="form-check-label" for="payrollCreate">
                    Remoção
                  </label>
                </div>
              </div>
            </div>
          </form>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sys-modules') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
