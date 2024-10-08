@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar chamado')

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
  <livewire:support.task.task-update :id="$id" />
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
