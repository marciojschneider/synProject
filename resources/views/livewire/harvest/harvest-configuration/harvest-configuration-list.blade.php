<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Configurações Safra</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
        {{-- Select registros por página --}}
        <div class="dataTables_length">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
        </div>

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          <a class="dt-button btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#filters"><span> <i
                class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca Avançada</span>
            </span>
          </a>
          <a class="dt-button add-new btn btn-primary" href="{{ route('harv-configuration-create') }}"><span> <i
                class="bx bx-plus me-0 me-sm-1"></i> <span class="d-none d-sm-inline-block">Novo</span>
            </span>
          </a>
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
      {{-- Busca por safras --}}
      <div id="harvestContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="harvest" id="harvest" name="harvest" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Safra" data-container="#harvestContainer">
          @foreach ($harvests as $harvest)
            <option value="{{ $harvest->id }}">{{ $harvest->code }} - {{ $harvest->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por secções --}}
      <div id="sectionContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="section" id="section" name="section" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Secção" data-container="#sectionContainer">
          @foreach ($sections as $section)
            <option value="{{ $section->id }}">{{ $section->code }} - {{ $section->name }} </option>
          @endforeach
        </select>
      </div>

      {{-- Busca por talhões --}}
      <div id="fieldContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="field" id="field" name="field" class="selectpicker col-sm-12" data-style="btn-default"
          data-live-search="true" placeholder="Talhão" data-container="#fieldContainer">
          @foreach ($fields as $field)
            <option value="{{ $field->id }}">{{ $field->code }} - {{ $field->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por culturas --}}
      <div id="cultureContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="culture" id="culture" name="culture" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Cultura" data-container="#cultureContainer">
          @foreach ($cultures as $culture)
            <option value="{{ $culture->id }}">{{ $culture->code }} - {{ $culture->name }}</option>
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
            <th>Safra</th>
            <th>Secção</th>
            <th>Talhão</th>
            <th>Cultura</th>
            <th>Variedade</th>
            <th>Método</th>
            <th>Organização</th>
            <th>Área Plantio</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ $row->cHarvest }}</td>
                <td>{{ $row->nSection }}</td>
                <td>{{ $row->cField }} - {{ $row->nField }}</td>
                <td>{{ $row->cCulture }} - {{ $row->nCulture }}</td>
                <td>{{ $row->cVariety }} - {{ $row->nVariety }}</td>
                <td>{{ $row->cPlantingMethod }} - {{ $row->nPlantingMethod }}</td>
                <td>{{ $row->cOrganization }}</td>
                <td>{{ number_format(floatval($row->planting_area), 0, ',', '.') }}</td>
                <td>
                  <span class="badge {{ $row->situation == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">
                    {{ $row->situation == 1 ? 'Aberto' : 'Fechado' }}
                  </span>
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('harv-configuration-update', $row->id) }}">
                        <i class="bx bx-edit-alt me-1"></i> Editar
                      </a>

                      <button type="submit" class="dropdown-item"
                        wire:click="removeRegister('/harvest/harvest-configurations', {{ $row->id }})">
                        <i class="bx bx-trash me-1"></i> Remover
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="10">Não hà registros</td>
            </tr>
          @endif
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
