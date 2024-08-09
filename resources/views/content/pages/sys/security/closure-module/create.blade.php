@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Nova Data de Fechamento')

@section('content')
  <livewire:sys.security.closure-module.closure-module-create />
@endsection

<script>
  // Inicio das implementações para o funcionamento do selectpicker.
  // 1° Sem estas implementações o mesmo deixa de renderizar após a atualização da seleção primária.
  //  2° Além disso, o mesmo não mantém os filtros no select após a troca da página, apenas na listagem.
  var option = '';

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
