@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Novo chamado')

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
      <span class="text-muted fw-light">Chamados /</span> Atualizar
    </h4>
    <div class="card mb-4">
      {{-- <h5 class="card-header">Novo chamado</h5> --}}
      <div class="card-body">
        <form method="POST" action="{{ route('sup-task-update', $task->id) }}">
          @csrf
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="name" class="form-label">Título</label>
              <input type="text" class="form-control" id="title" name="title" maxlength="50"
                value="{{ $task->title }}" />
            </div>

            <div class="col-md-2">
              <label for="module" class="form-label">Módulo</label>
              <select id="module" name="module" class="form-select">
                @foreach ($modules as $module)
                  <option value="{{ $module->id }}" {{ str_contains($task->module_id, $module->id) ? 'selected' : '' }}>
                    {{ $module->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label for="situation" class="form-label">Situação</label>
              <select id="situation" name="situation" class="form-select">
                <option value="1" {{ $task->situation == 1 ? 'selected' : '' }}>Solicitado</option>
                <option value="2" {{ $task->situation == 2 ? 'selected' : '' }}>Em desenvolvimento</option>
                <option value="3" {{ $task->situation == 3 ? 'selected' : '' }}>Pendente</option>
                <option value="4">Aprovado</option>
                <option value="5">Inativo</option>
              </select>
            </div>

            <div class="col-md-2">
              <label for="solicitation" class="form-label">Solicitação</label>
              <input class="form-control" type="datetime-local" step="1" value="{{ $task->initial_dt }}" readonly
                id="solicitation" name="solicitation" onchange="updateData()" />
            </div>

            <div class="col-md-2">
              <label for="expectation" class="form-label">Expectativa</label>
              <input class="form-control" type="datetime-local" step="1" value="{{ $task->expected_dt }}"
                id="expectation" name="expectation" />
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-12">
              <label for="defaultSelect" class="form-label">Descrição</label>
              <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
                name="description" maxlength="250" rows="4"> {{ $task->description }} </textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
          <a href="{{ route('sup-tasks') }}" class="btn btn-secondary">Voltar</a>
          <a class="btn btn-danger" onclick="removeModal({{ $task->id }})" href="#">Excluir</a>
        </form>

        <form method="POST" id="deleteForm{{ $task->id }}" action="{{ route('sup-task-delete', $task->id) }}">
          @csrf
        </form>
      </div>
    </div>
  </div>
@endsection

<script>
  function removeModal(id) {
    Swal.fire({
      title: 'Você tem certeza?',
      text: "Essa ação não será revertida!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, deletar isso!',
      cancelButtonText: 'Cancelar',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function(result) {
      if (result.value) {
        Swal.fire({
          icon: 'success',
          title: 'Deletado!',
          text: 'O registro foi removido do sistema.',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        }).then(function(result) {
          sendDelete(id)
        });
      }
    });
  }

  function sendDelete(id) {
    document.getElementById('deleteForm' + id).submit();
  }
</script>
