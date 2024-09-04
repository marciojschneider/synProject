<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Embarques</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
        {{-- Select registros por página --}}
        <div class="dataTables_length" style="margin-right: 5px;">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
          </select>
        </div>

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          @if (auth()->user()->in_profile != 5)
            <a class="dt-button btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#filters"><span>
                <i class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca Avançada</span>
              </span>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Offcanvas Busca Avançada -->
  <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="filters"
    aria-labelledby="filtersLabel" wire:ignore.self>
    <div class="offcanvas-header">
      <h5 id="filtersLabel" class="offcanvas-title">Filtrar</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mx-0 flex-grow-0" style="height: 87%">
      {{-- Pesquisa por Embarque --}}
      <div id="boarding" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <input wire:model="boarding" type="search" class="form-control col-sm-12" placeholder="Embarque">
      </div>

      {{-- Pesquisa por Pedido --}}
      <div id="request" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <input wire:model="request" type="request" class="form-control col-sm-12" placeholder="Pedido">
      </div>

      {{-- Pesquisa por ERP --}}
      <div id="erp" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <input wire:model="erp" type="erp" class="form-control col-sm-12" placeholder="ERP">
      </div>

      {{-- Busca por Separador --}}
      <div id="separadorContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="separador" id="separador" name="separador" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Separador" data-container="#separadorContainer">
          @foreach ($separadores as $separador)
            <option value="{{ $separador->user_id }}">{{ mb_strtoupper($separador->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Perfil --}}
      <div id="situationContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="situation" id="situation" name="situation" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Situação" data-container="#situationContainer"
          multiple>
          <option value="1">Sem separador</option>
          <option value="2">Sem leitura</option>
          <option value="3">Com leitura</option>
          <option value="4">Finalizado</option>
          <option value="5">Exportado</option>
        </select>
      </div>
    </div>

    <div class="offcanvas-body">
      <div class="d-flex justify-content-between">
        <button wire:click="search" class="btn btn-success">Buscar</button>
        <button wire:click="clean" onclick="cleanFilters()" class="btn btn-danger">Limpar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Fechar</button>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Embarque</th>
            <th>Pedido</th>
            <th>Pedido ERP</th>
            <th>Cliente</th>
            <th>Separador</th>
            <th>Data</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ $row->number }}</td>
                <td>{{ $row->request }}</td>
                <td>{{ $row->request_erp }}</td>
                <td>{{ $row->client }}</td>
                <td>{{ $row->uName }}</td>
                <td>{{ date('d/m/Y', strtotime($row->date)) }}</td>
                <td> <span class="badge bg-{{ $row->cSituation }} me-1"> {{ $row->nSituation }} </span> </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      @switch(auth()->user()->in_profile)
                        @case(5)
                          <a class="dropdown-item" href="{{ route('boar-boarding-read', $row->id) }}">
                            <i class="bx bx-edit-alt me-1"></i> Ler
                          </a>
                        @break

                        @default
                          <a class="dropdown-item" href="{{ route('boar-boarding-update', $row->id) }}">
                            <i class="bx bx-edit-alt me-1"></i> Editar
                          </a>
                      @endswitch
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="8">Não hà registros</td>
            </tr>
          @endif
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
