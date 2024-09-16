@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Importação')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/extended-ui-sweetalert2.js'])
@endsection

@section('content')
  <livewire:boarding.boarding.boarding-import />
@endsection

<script>
  window.addEventListener('success', function(e) {
    Swal.fire({
      icon: 'success',
      title: 'Sucesso!',
      text: 'Importação de dados concluida.',
      customClass: {
        confirmButton: 'btn btn-success'
      }
    }).then(function() {
      window.location.href = "{{ route('boar-boardings') }}";
    })
  });
</script>
