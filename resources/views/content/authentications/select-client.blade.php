@extends('layouts/blankLayout')

@section('title', 'Organizações')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            {{-- <div class="app-brand justify-content-center mt-2">
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo"><img src="assets/img/kettlow/logotipo-soft-purple-696cff.png" /></span>
              </a>
            </div> --}}
            <!-- /Logo -->
            <h3 class="mb-4" style="text-align: center">Selecione uma organização</h3>
            {{-- <p class="mb-4"></p> --}}

            <form method="POST" action="{{ route('select-client') }}">
              @csrf
              <div class="mb-4">
                {{-- <label for="exampleFormControlSelect1" class="form-label">Estabelecimentos</label> --}}
                <select class="selectpicker col-sm-12" data-style="btn-default" name="client_id" id="client_id"
                  aria-label="Estabelecimentos">
                  @foreach ($clients as $client)
                    <option value="{{ $client['idClient'] }}">{{ $client['nClient'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Selecionar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
  </div>
@endsection
