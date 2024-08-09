@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Safra')

@section('content')
  <livewire:harvest.harvest.harvest-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=price_table]').val(event.detail[0].price_table);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
