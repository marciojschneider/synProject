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
  <livewire:task-list />

  <!-- Offcanvas to add new comment -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddComment" aria-labelledby="offcanvasAddCommentLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddCommentLabel" class="offcanvas-title">Adicionar comentário</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-comment pt-0" id="addNewCommentForm" method="POST" action="{{ route('sup-comment') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label" for="add-comment-task">Tarefa</label>
          <select id="add-comment-task" name="commentTask" class="select2 form-select">
            @foreach ($unapproveds as $unapproved)
              <option value="{{ $unapproved->id }}">{{ $unapproved->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-comment-description">Descrição</label>
          <textarea class="form-control" id="add-comment-description" placeholder="Descrição" name="commentDescription"
            aria-label="description" maxlength="250" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Enviar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>

  <!-- Offcanvas to update comment -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUpdateComment"
    aria-labelledby="offcanvasUpdateCommentLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasUpdateCommentLabel" class="offcanvas-title">Atualizar comentário</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="update-report pt-0" id="updatecommentForm" method="POST" action="{{ route('sup-comment-update') }}">
        @csrf
        <input type="hidden" id="update-comment-id" name="commentId" />
        <div class="mb-3">
          <label class="form-label" for="update-comment-task">Tarefa</label>
          <select id="update-comment-task" name="commentTask" class="select2 form-select">
            @foreach ($unapproveds as $unapproved)
              <option value="{{ $unapproved->id }}">{{ $unapproved->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="update-comment-description">Descrição</label>
          <textarea class="form-control" id="update-comment-description" placeholder="Descrição" name="commentDescription"
            aria-label="description" maxlength="250" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Atualizar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
@endsection

<script>
  function newModal(data) {
    $('#add-comment-task option[value="' + data + '"]').prop('selected', true);
  }

  function updateModal(data) {
    $('#update-comment-id').val(data.id)

    $('#update-comment-task option[value="' + data.task_id + '"]').prop('selected', true);
    $('#update-comment-description').val(data.description)
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
    document.getElementById('commentDelete' + id).submit();
  }
</script>
