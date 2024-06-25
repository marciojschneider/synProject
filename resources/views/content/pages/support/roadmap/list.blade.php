@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Chamados')

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
  <livewire:support.roadmap.roadmap-list />

  <!-- Offcanvas to add new roadmap -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddRoadmap" aria-labelledby="offcanvasAddRoadmapLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRoadmapLabel" class="offcanvas-title">Adicionar report</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-report pt-0" id="addNewRoadmapForm" method="POST" action="{{ route('sup-roadmap') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-task">Tarefa</label>
          <select id="add-roadmap-task" name="roadmapTask" class="select2 form-select">
            @foreach ($unapproveds as $unapproved)
              <option value="{{ $unapproved->id }}">{{ $unapproved->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-commit">Commit</label>
          <input type="text" class="form-control" id="add-roadmap-commit" placeholder="Commit" name="roadmapCommit"
            aria-label="commit" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-description">Descrição</label>
          <textarea class="form-control" id="add-roadmap-description" placeholder="Descrição" name="roadmapDescription"
            aria-label="description" maxlength="250" rows="4"></textarea>
        </div>
        <div class="mb-3">
          <label for="add-roadmap-dt-solicitation" class="col-form-label">Solicitação</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" step="1"
              value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="add-roadmap-dt-solicitation"
              name="roadmapDtSolicitation" />
          </div>
        </div>
        <div class="mb-3">
          <label for="add-roadmap-dt-final" class="col-form-label">Finalização</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" step="1"
              value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="add-roadmap-dt-final"
              name="roadmapDtFinal" />
          </div>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Enviar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>

  <!-- Offcanvas to update roadmap -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUpdateRoadmap"
    aria-labelledby="offcanvasUpdateRoadmapLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasUpdateRoadmapLabel" class="offcanvas-title">Atualizar report</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="update-report pt-0" id="updateRoadmapForm" method="POST" action="{{ route('sup-roadmap-update') }}">
        @csrf
        <input type="hidden" id="update-roadmap-id" name="roadmapId" />
        <div class="mb-3">
          <label class="form-label" for="update-roadmap-task">Tarefa</label>
          <select id="update-roadmap-task" name="roadmapTask" class="select2 form-select">
            @foreach ($unapproveds as $unapproved)
              <option value="{{ $unapproved->id }}">{{ $unapproved->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="update-roadmap-commit">Commit</label>
          <input type="text" class="form-control" id="update-roadmap-commit" placeholder="Commit" name="roadmapCommit"
            aria-label="commit" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="update-roadmap-description">Descrição</label>
          <textarea type="text" class="form-control" id="update-roadmap-description" placeholder="Descrição"
            name="roadmapDescription" aria-label="description" maxlength="250" rows="4"></textarea>
        </div>
        <div class="mb-3">
          <label for="update-roadmap-dt-solicitation" class="col-form-label">Solicitação</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" step="1"
              value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="update-roadmap-dt-solicitation"
              name="roadmapDtSolicitation" />
          </div>
        </div>
        <div class="mb-3">
          <label for="update-roadmap-dt-final" class="col-form-label">Finalização</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" step="1"
              value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="update-roadmap-dt-final"
              name="roadmapDtFinal" />
          </div>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Atualizar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
@endsection

<script>
  function newModal(data) {
    $('#add-roadmap-task option[value="' + data + '"]').prop('selected', true);
  }

  function updateModal(data) {
    // document.getElementById('updateRoadmapForm').action = "{{ route('sup-roadmap-update') }}";
    $('#update-roadmap-id').val(data.id)

    $('#update-roadmap-task option[value="' + data.task_id + '"]').prop('selected', true);
    $('#update-roadmap-commit').val(data.commit_reference)
    $('#update-roadmap-description').val(data.description)

    // var initialFormated = data.initial_dt.substring(0, data.initial_dt.length - 3)
    $('#update-roadmap-dt-solicitation').val(data.initial_dt)

    // var finalFormated = data.ending_dt.substring(0, data.ending_dt.length - 3)
    $('#update-roadmap-dt-final').val(data.ending_dt)
  }

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
    document.getElementById('roadmapDelete' + id).submit();
  }
</script>
