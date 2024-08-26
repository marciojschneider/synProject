@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Clientes')

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
  <livewire:sys.client.client-list />
@endsection

<script>
  window.addEventListener('swal', function(e) {
    if (e.detail[0].title === 'Sem Permissão') {
      Swal.fire({
        title: e.detail[0].title,
        icon: e.detail[0].icon,
      });

      return;
    }

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
          Livewire.dispatch('removeAction', {
            id: e.detail[0].id
          });
        });
      }
    });
  });
</script>
