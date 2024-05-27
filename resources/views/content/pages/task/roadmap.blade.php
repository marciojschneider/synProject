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

  <!-- Add -->
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

  {{-- Listagem --}}
  <div class="card g-3 mt-2">
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
                      data-bs-target="#offcanvasAddUser"> +
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
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Full Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname"
            aria-label="John Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com"
            aria-label="john.doe@example.com" name="userEmail" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11"
            aria-label="john.doe@example.com" name="userContact" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">Company</label>
          <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1"
            name="companyName" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="country">Country</label>
          <select id="country" class="select2 form-select">
            <option value="">Select</option>
            <option value="Australia">Australia</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Belarus">Belarus</option>
            <option value="Brazil">Brazil</option>
            <option value="Canada">Canada</option>
            <option value="China">China</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Japan">Japan</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Mexico">Mexico</option>
            <option value="Philippines">Philippines</option>
            <option value="Russia">Russian Federation</option>
            <option value="South Africa">South Africa</option>
            <option value="Thailand">Thailand</option>
            <option value="Turkey">Turkey</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" class="form-select">
            <option value="subscriber">Subscriber</option>
            <option value="editor">Editor</option>
            <option value="maintainer">Maintainer</option>
            <option value="author">Author</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Select Plan</label>
          <select id="user-plan" class="form-select">
            <option value="basic">Basic</option>
            <option value="enterprise">Enterprise</option>
            <option value="company">Company</option>
            <option value="team">Team</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
@endsection
