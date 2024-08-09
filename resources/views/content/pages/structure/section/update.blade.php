@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Secção')

@section('content')
  <livewire:structure.section.section-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=organization]').val(event.detail[0].organization);
    $('select[name=responsible]').val(event.detail[0].responsible);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
