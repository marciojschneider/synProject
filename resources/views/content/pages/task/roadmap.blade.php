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

  <!-- Add Collumn -->
  <div class="d-flex flex-wrap justify-content-between align-items-center">
    <div class="d-flex flex-column justify-content-center">
      <h4 class="mb-1 mt-3">Adicionar um report ao roadmap</h4>
      <p class="text-muted">Report's serão vinculádos à uma tarefa em aberto.</p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">{{-- Botão de novo usuário --}}
      <div class="dt-buttons" bis_skin_checked="1">
        <a class="dt-button add-new btn btn-primary" href="#"><span> <i class="bx bx-plus me-0 me-sm-1"></i><span
              class="d-none d-sm-inline-block">Novo</span>
          </span>
        </a>
      </div>
    </div>
  </div>

  <div class="card g-3 mt-3">
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
                  <span class="d-flex flex-column">
                    <span class="h5 mb-1">{{ $task->title }}
                      <div class="badge bg-{{ $task->cSituation }} rounded-pill ms-auto" bis_skin_checked="1">
                        {{ $task->nSituation }} </div>
                    </span>
                    <span class="fw-normal">
                      Inicio: {{ date('d/m/Y', strtotime($task->initial_dt)) }} |
                      Expectativa: {{ date('d/m/Y', strtotime($task->expected_dt)) }}
                    </span>
                  </span>
                </button>
              </div>
              @foreach ($task->details as $detail)
                <div id="chapter{{ $task->id }}" class="accordion-collapse collapse" data-bs-parent="#courseContent">
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
                </div>
              @endforeach
            </div>
          @endforeach
          {{-- Fim do item --}}
        </div>
      </div>
    </div>
  </div>
@endsection
