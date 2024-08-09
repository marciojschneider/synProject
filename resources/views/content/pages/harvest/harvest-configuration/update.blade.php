@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Configuração Safra')

@section('content')
  <livewire:harvest.harvest-configuration.harvest-configuration-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=harvest]').val(event.detail[0].harvest);
    $('select[name=section]').val(event.detail[0].section);
    $('select[name=field]').val(event.detail[0].field);
    $('select[name=culture]').val(event.detail[0].culture);
    $('select[name=variety]').val(event.detail[0].variety);
    $('select[name=planting_method]').val(event.detail[0].planting_method);
    $('select[name=situation]').val(event.detail[0].situation);
    $('select[name=organization]').val(event.detail[0].organization);
  })
</script>
