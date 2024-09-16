<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Embarques</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
        {{-- Select registros por página --}}
        <div class="dataTables_length">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
          </select>
        </div>

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          <a class="dt-button btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#filters"><span>
              <i class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca Avançada</span>
            </span>
          </a>
          <a class="dt-button btn btn-secondary" href="{{ route('boar-boarding-update', $id) }}"> Voltar </a>
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
      {{-- Busca por Separador --}}
      <div id="itemContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="item" id="item" name="item" class="selectpicker col-sm-12" data-style="btn-default"
          data-live-search="true" placeholder="Item" data-container="#itemContainer">
          @foreach ($items as $item)
            <option value="{{ $item->code }}">{{ $item->code }}</option>
          @endforeach
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
            <th>Item</th>
            <th>Lote</th>
            <th>Quantidade</th>
            <th>Leitura</th>
            <th>Externo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ $row->item_code }}</td>
                <td>{{ $row->batch }}</td>
                <td>{{ $row->amount }}</td>
                <td>{{ $row->full_code }}</td>
                <td>{{ $row->external_id }}</td>
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
                          <button type="submit" class="dropdown-item"
                            wire:click="removeRegister('/boarding/boarding/detail', {{ $row->id }})">
                            <i class="bx bx-trash me-1"></i> Remover
                          </button>
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
