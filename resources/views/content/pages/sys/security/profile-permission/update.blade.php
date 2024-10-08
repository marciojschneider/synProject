@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Permissão')

@section('content')
  <livewire:sys.security.profile-permission.profile-permission-update :id="$id" />
@endsection

<script>
  // Inicio das implementações para o funcionamento do selectpicker.
  // 1° Sem estas implementações o mesmo deixa de renderizar após a atualização da seleção primária.
  var option = '';

  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=module]').val(event.detail[0].module);
    $('select[name=screen]').val(event.detail[0].screen);
    $('select[name=profile]').val(event.detail[0].profile);
    $('select[name=situation]').val(event.detail[0].situation);
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
</script>
