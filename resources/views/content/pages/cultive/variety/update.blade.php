@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Variedade')

{{-- Verificar estilizações necessárias para o funcionamento da pagina --}}
@section('vendor-style')
  @vite(['resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss', 'resources/assets/vendor/libs/plyr/plyr.scss'])
@endsection

@section('page-style')
  @vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js', 'resources/assets/vendor/libs/plyr/plyr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/extended-ui-sweetalert2.js', 'resources/assets/js/app-academy-course-details.js'])
@endsection

@section('content')
  <div class="col-md">
    <h4 class="mb-4">
      <span class="text-muted fw-light">Variedade /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('cultive-variety-update', $variety->id) }}">
          @csrf

          <div class="row mb-4">
            <div class="col-md-2">
              <label for="code" class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" maxlength="50"
                value="{{ $variety->code }}" />
            </div>

            <div class="col-md-4">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50"
                value="{{ $variety->name }}" />
            </div>

            <div class="col-md-2">
              <label for="culture" class="form-label">Cultura</label>
              <select id="culture" name="culture" class="form-select">
                @foreach ($cultures as $culture)
                  <option value="{{ $culture->id }}"
                    {{ str_contains($variety->culture_id, $culture->id) ? 'selected' : '' }}> {{ $culture->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="group" class="form-label">Grupo</label>
              <select id="group" name="group" class="form-select">
                @foreach ($groups as $group)
                  <option value="{{ $group->id }}"
                    {{ str_contains($variety->group_id, $group->id) ? 'selected' : '' }}> {{ $group->name }} </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="0" {{ str_contains($variety->situation, 0) ? 'selected' : '' }}>Inativo</option>
                <option value="1" {{ str_contains($variety->situation, 1) ? 'selected' : '' }}>Ativo</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('cultive-varieties') }}" class="btn btn-secondary">Voltar</a>
        </form>
      </div>
    </div>
  </div>
@endsection
