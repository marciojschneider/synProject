@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Perfil')

@section('content')
  <livewire:sys.sidebar.sidebar-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    console.log(event.detail[0].client);
    $('select[name=module]').val(event.detail[0].module);
    $('select[name=client]').val(event.detail[0].client);
    $('select[name=visualization]').val(event.detail[0].visualization);

    // Necessário para a renderização correta do multiple
    $('#client').selectpicker('destroy');
    $('#client').selectpicker();
  })
</script>
