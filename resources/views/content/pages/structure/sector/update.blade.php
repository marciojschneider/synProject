@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Setor')

@section('content')
  <livewire:structure.sector.sector-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=farm]').val(event.detail[0].farm);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
