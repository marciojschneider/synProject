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
  <h4 class="mb-0">
    Chamados
  </h4>

  <!-- Add -->
  <div class="d-flex flex-wrap justify-content-between align-items-center">
    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Adicionar um chamado</h4>
      <p class="text-muted">Os chamados serão feitos conforme a data da adesão definida no sistema.</p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">{{-- Botão de novo usuário --}}
      <div class="dt-buttons" bis_skin_checked="1">
        <a class="dt-button add-new btn btn-primary" href="{{ route('sup-task-create') }}"><span> <i
              class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Novo</span>
          </span>
        </a>
      </div>
    </div>
  </div>

  {{-- Listagem --}}
  <div class="card g-3 mt-1">
    <div class="card-body row g-3">
      <div class="col-lg-12">
        <div class="accordion stick-top accordion-bordered" id="courseContent">
          {{-- Inicio do item --}}
          @foreach ($tasks as $task)
            <div class="accordion-item shadow-none border mb-0">
              <div class="accordion-header" id="headingOne">
                <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse"
                  data-bs-target="#chapter{{ $task->id }}" aria-expanded="false"
                  aria-controls="chapter{{ $task->id }}">
                  <div class="d-flex flex-row">
                    @if ($task->situation != 4)
                      <a class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddComment"
                        onclick="newModal({{ $task->id }})" href="#"> <i class="bx bx-plus me-1"></i>
                      </a>
                      <a class="btn btn-outline-warning" style="margin-left: 5px"
                        href="{{ route('sup-task-update', $task->id) }}">
                        <i class="bx bx-edit-alt me-1"></i>
                      </a>
                    @endif

                    <div class="d-flex flex-column" style="margin-left: 5px;">
                      <span class="h5 mb-1">{{ $task->title }}
                        <div class="badge bg-{{ $task->cSituation }} rounded-pill ms-auto" bis_skin_checked="1">
                          {{ $task->nSituation }}
                        </div>
                      </span>
                      <span class="fw-normal">
                        Inicio: {{ date('d/m/Y', strtotime($task->initial_dt)) }} |
                        Expectativa: {{ date('d/m/Y', strtotime($task->expected_dt)) }}
                      </span>
                    </div>
                  </div>
                </button>
              </div>
              <div id="chapter{{ $task->id }}" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                @foreach ($task->details as $detail)
                  <div class="accordion-body py-3 border-top">
                    <div class="d-flex">
                      {{-- <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" /> --}}
                      <label for="defaultCheck1" class="form-check-label col-sm-10">
                        <span class="mb-0 h6">Detalhamento:</span>
                        <span class="text-muted d-block"> {{ $detail->description }}</span>
                      </label>
                      @if ($task->situation != 4)
                        {{-- Botões de ação --}}
                        <form method="POST" action="{{ route('sup-comment-delete', $detail->id) }}"
                          id="commentDelete{{ $detail->id }}" display="none">
                          @csrf
                        </form>
                        <div class="d-flex flex-row-reverse col-sm-2">
                          <a class="btn btn-outline-danger m-1" onclick="removeModal({{ $detail->id }})"
                            href="#"> <i class="bx bx-trash me-1"></i>
                          </a>
                          <a class="btn btn-outline-warning m-1" onclick="updateModal({{ $detail }})"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpdateComment" href="#"> <i
                              class="bx bx-edit-alt me-1"></i>
                          </a>
                        </div>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
          {{-- Fim do item --}}
        </div>
      </div>
    </div>
  </div>

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
            aria-label="description" maxlength="250" rows="4"> </textarea>
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
      <form class="update-report pt-0" id="updatecommentForm" method="POST"
        action="{{ route('sup-comment-update') }}">
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
            aria-label="description" maxlength="250" rows="4"> </textarea>
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
