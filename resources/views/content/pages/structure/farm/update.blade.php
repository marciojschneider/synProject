@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Atualizar Fazenda')

@section('content')
  <livewire:structure.farm.farm-update :id="$id" />
@endsection

<script>
  // Responsável por carregar os dados da busca salva.
  window.addEventListener('loadDataSelect', event => {
    $('select[name=property]').val(event.detail[0].property);
    $('select[name=owner]').val(event.detail[0].owner);
    $('select[name=situation]').val(event.detail[0].situation);
  })
</script>
