<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Módulos</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
        {{-- Select registros por página --}}
        <div class="dataTables_length" style="margin-right: 5px;">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
        </div>

        {{-- Caixa de pesquisa --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1">
          <label><input wire:model.live.debounce.500ms="searchText" type="search" class="form-control"
              placeholder="Buscar..." aria-controls="DataTables_Table_0"></label>
        </div>

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          <a class="dt-button btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#filters"><span> <i
                class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca Avançada</span>
            </span>
          </a>
          <a class="dt-button add-new btn btn-primary" href="{{ route('sys-sidebar-create') }}"><span> <i
                class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Novo</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Offcanvas Busca Avançada -->
  <div class="offcanvas offcanvas-end" tabindex="-1" data-bs-backdrop="false" id="filters"
    aria-labelledby="filtersLabel" wire:ignore.self>
    <div class="offcanvas-header">
      <h5 id="filtersLabel" class="offcanvas-title">Filtrar</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0" style="height: 87%">
      {{-- Busca por Afiliado --}}
      <div id="moduleContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model.live.click="module" id="module" name="module" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Módulo" data-container="#moduleContainer">
          <option value="0"> PRINCIPAL </option>
          @foreach ($modules as $module)
            <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Clientes --}}
      <div id="clientContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="client" id="client" name="client" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Cliente" data-container="#clientContainer">
          @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ mb_strtoupper($client->name, 'UTF-8') }}</option>
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
            <th>Nome</th>
            <th>Afiliado</th>
            <th>Clientes</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ $row->name }}</td>
                <td> <span class="badge bg-{{ $row->aColor }} me-1"> {{ $row->aName }} </span> </td>
                <td>
                  @foreach ($row->cName as $cName)
                    <span class="badge bg-label-primary me-1"> {{ $cName }} </span>
                  @endforeach
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('sys-sidebar-update', $row->id) }}">
                        <i class="bx bx-edit-alt me-1"></i> Editar
                      </a>

                      <button type="submit" class="dropdown-item"
                        wire:click="removeRegister('/sys/sidebars', {{ $row->id }})">
                        <i class="bx bx-trash me-1"></i> Remover
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="4">Não hà registros</td>
            </tr>
          @endif
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
