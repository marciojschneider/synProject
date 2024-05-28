@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Tarefas')

@section('vendor-style')
  @vite('resources/assets/vendor/libs/plyr/plyr.scss')
@endsection

@section('page-style')
  @vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

@section('vendor-script')
  @vite('resources/assets/vendor/libs/plyr/plyr.js')
@endsection

@section('page-script')
  @vite('resources/assets/js/app-academy-course-details.js')
@endsection

@section('content')
  <h4 class="mb-0">
    <span class="text-muted fw-light">Tarefas /</span> Roadmap
  </h4>

  {{-- Listagem --}}
  <div class="card g-3 mt-4">
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
                    <a class="add-new btn btn-outline-primary" data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasAddRoadmap"> +
                    </a>

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
                    <div class="d-flex align-items-center">
                      {{-- <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" /> --}}
                      <label for="defaultCheck1" class="form-check-label">
                        <span class="mb-0 h6">Titulo: {{ $detail->description }}</span>
                        <span class="text-muted d-block">Commit: {{ $detail->commit_reference }}</span>
                        <span class="text-muted d-block">Inicio:
                          {{ date('d/m/Y H:i:s', strtotime($detail->initial_dt)) }}
                          | Fim:
                          {{ date('d/m/Y H:i:s', strtotime($detail->ending_dt)) }}</span>
                      </label>
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
  <!-- Offcanvas to add new roadmap -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddRoadmap" aria-labelledby="offcanvasAddRoadmapLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddRoadmapLabel" class="offcanvas-title">Adicionar report</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-report pt-0" id="addNewRoadmapForm" onsubmit="return false">
        <div class="mb-3">
          <label class="form-label" for="task">Tarefa</label>
          <select id="task" class="select2 form-select">
            <option value="">Selecione uma tarefa</option>
            <option value="1">Estrutura básica</option>
            <option value="2">CRUD Tarefas - Base</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-title">Título</label>
          <input type="text" class="form-control" id="add-roadmap-title" placeholder="Título" name="roadmapTitle"
            aria-label="title" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-commit">Commit</label>
          <input type="text" class="form-control" id="add-roadmap-commit" placeholder="Commit" name="roadmapCommit"
            aria-label="commit" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-roadmap-description">Descrição</label>
          <input type="text" class="form-control" id="add-roadmap-description" placeholder="Descrição"
            name="roadmapDescription" aria-label="description" />
        </div>
        <div class="mb-3">
          <label for="add-roadmap-dt-solicitation" class="col-form-label">Solicitação</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" value="{{ now('America/Sao_Paulo') }}"
              id="add-roadmap-dt-solicitation" />
          </div>
        </div>
        <div class="mb-3">
          <label for="add-roadmap-dt-final" class="col-form-label">Finalização</label>
          <div class="col-md-12">
            <input class="form-control" type="datetime-local" value="{{ now('America/Sao_Paulo') }}"
              id="add-roadmap-dt-final" />
          </div>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Enviar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
      </form>
    </div>
  </div>
@endsection
