@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Módulos')

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
  <livewire:sys.security.profile-permission.profile-permission-list />
@endsection

<script>
  // Inicio das implementações para o funcionamento do selectpicker.
  // 1° Sem estas implementações o mesmo deixa de renderizar após a atualização da seleção primária.
  //  2° Além disso, o mesmo não mantém os filtros no select após a troca da página, apenas na listagem.
  var option = '';

  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=module]').val(event.detail[0].module);
    $('select[name=screen]').val(event.detail[0].screen);
    $('select[name=profile]').val(event.detail[0].profile);
  })

  // Responsável por atualizar os dados do select (telas) após selecionar o módulo.
  window.addEventListener('screens', event => {
    option = '';

    $('#screen').selectpicker('destroy');

    for (var i = 0; i < event.detail[0].length; i++) {
      option += '<option value="' + event.detail[0][i].id + '">' + event.detail[0][i].name.toUpperCase() +
        '</option>';
      $('#screen').html(option).show();
    }

    $('#screen').selectpicker();
  })
  // Fim das implementações para o uso do selectpicker.

  function cleanFilters() {
    $('.selectpicker').selectpicker('val', null);
  }

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
          sendDelete(e.detail[0].id)
        });
      }
    });
  });

  function sendDelete(id) {
    document.getElementById('permissionDelete' + id).submit();
  }
</script>
