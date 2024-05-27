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
  {{-- <h4 class="pt-3 mb-0">
    <span class="text-muted fw-light">Academy /</span> Course Details
  </h4> --}}

  <div class="card g-3">
    <div class="card-body row g-3">
      <div class="col-lg-12">
        <div class="accordion stick-top accordion-bordered" id="courseContent">
          {{-- Inicio do item --}}
          @foreach ($tasks as $task)
            <div class="accordion-item shadow-none border active mb-0">
              <div class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button bg-lighter rounded-0" data-bs-toggle="collapse"
                  data-bs-target="#chapter{{ $task->id }}" aria-expanded="true"
                  aria-controls="chapter{{ $task->id }}">
                  <span class="d-flex flex-column">
                    <span class="h5 mb-1">{{ $task->title }}</span>
                    <span class="fw-normal">
                      Inicio: {{ date('d/m/Y', strtotime($task->initial_dt)) }} |
                      Expectativa: {{ date('d/m/Y', strtotime($task->expected_dt)) }}
                    </span>
                  </span>
                </button>
              </div>
              @foreach ($task->details as $detail)
                <div id="chapter{{ $task->id }}" class="accordion-collapse collapse show"
                  data-bs-parent="#courseContent">
                  <div class="accordion-body py-3 border-top">
                    <div class="form-check d-flex align-items-center mb-3">
                      <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" />
                      <label for="defaultCheck1" class="form-check-label ms-3">
                        <span class="mb-0 h6">{{ $detail->description }}</span>
                        <span class="text-muted d-block">Inicio: {{ date('d/m/Y H:i:s', strtotime($detail->initial_dt)) }}
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
