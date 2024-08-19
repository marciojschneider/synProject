<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Hora Máquinas</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div class="d-flex justify-content-end">
        {{-- Select registros por página --}}
        <div class="dataTables_length" style="margin-right: 5px;">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
        </div>

        {{-- Caixa de pesquisa --}}
        <div class="dataTables_filter" bis_skin_checked="1">
          <label><input wire:model.live.debounce.500ms="searchText" type="search" class="form-control"
              placeholder="Buscar..." aria-controls="DataTables_Table_0"></label>
        </div>

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          <a class="dt-button btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#filters"><span> <i
                class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca Avançada</span>
            </span>
          </a>
          <a class="dt-button add-new btn btn-primary" href="{{ route('cultive-machine-hour-create') }}"><span> <i
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
      {{-- Busca por Organização --}}
      <div id="organizationContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="organization" id="organization" name="organization" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Organização"
          data-container="#organizationContainer">
          @foreach ($organizations as $organization)
            <option value="{{ $organization->id }}">{{ $organization->code }} -
              {{ mb_strtoupper($organization->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Safra --}}
      <div id="harvestContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="harvest" id="harvest" name="harvest" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Safra" data-container="#harvestContainer">
          @foreach ($harvests as $harvest)
            <option value="{{ $harvest->id }}">{{ $harvest->code }} -
              {{ mb_strtoupper($harvest->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por organização --}}
      <div id="sectionContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="section" id="section" name="section" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Secção" data-container="#sectionContainer">
          @foreach ($sections as $section)
            <option value="{{ $section->id }}">{{ $section->code }} -
              {{ mb_strtoupper($section->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>
      {{-- Busca por organização --}}
      <div id="fieldContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="field" id="field" name="field" class="selectpicker col-sm-12" data-style="btn-default"
          data-live-search="true" placeholder="Talhão" data-container="#fieldContainer">
          @foreach ($fields as $field)
            <option value="{{ $field->id }}">{{ $field->code }} -
              {{ mb_strtoupper($field->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Processo --}}
      <div id="processContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="process" id="process" name="process" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Processo"
          data-container="#processContainer">
          @foreach ($processes as $process)
            <option value="{{ $process->id }}">{{ $process->code }} -
              {{ mb_strtoupper($process->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Equipamento --}}
      <div id="equipamentContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="equipament" id="equipament" name="equipament" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Equipamento"
          data-container="#equipamentContainer">
          <option value="1">EQUIPAMENTO FICTICIO 01</option>
          <option value="2">EQUIPAMENTO FICTICIO 02</option>
        </select>
      </div>

      {{-- Busca por Implemento --}}
      <div id="implementContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="implement" id="implement" name="implement" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Implemento"
          data-container="#implementContainer">
          <option value="1">IMPLEMENTO FICTICIO 01</option>
          <option value="2">IMPLEMENTO FICTICIO 02</option>
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
            <th>Boletim</th>
            <th>Org</th>
            <th>Safra</th>
            <th>Secção</th>
            <th>Talhão</th>
            <th>Processo</th>
            <th>Equipamento</th>
            <th>Implemento</th>
            <th>Data</th>
            <th>Inicial</th>
            <th>Final</th>
            <th>Quantidade</th>
            <th>R. Inicial</th>
            <th>R. Final</th>
            <th>Qt. Caixa</th>
            <th>Qt. Diesel</th>
            <th>Hr. Diesel</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($rows as $row)
            <tr>
              <td>{{ $row->report }}</td>
              <td>{{ $row->cOrganization }}</td>
              <td>{{ $row->cHarvest }}</td>
              <td>{{ $row->cSection }} - {{ $row->nSection }}</td>
              <td>{{ $row->cField }}</td>
              <td>{{ $row->cProcess }} - {{ $row->nProcess }}</td>
              <td>{{ $row->equipament_id }}</td>
              <td>{{ $row->implement_id }}</td>
              <td>{{ date('d/m/Y', strtotime($row->transaction_dt)) }}</td>
              <td>{{ number_format(floatval($row->hourmeter_start), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->hourmeter_end), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->hourmeter_quantity), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->hourmeter_rotor_start), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->hourmeter_rotor_end), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->quantity_box), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->quantity_diesel), 2, ',', '.') }}</td>
              <td>{{ number_format(floatval($row->hourmeter_diesel), 2, ',', '.') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                      class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('cultive-machine-hour-update', $row->id) }}"><i
                        class="bx bx-edit-alt me-1"></i> Editar</a>

                    <form method="POST" action="{{ route('cultive-machine-hour-delete', $row->id) }}"
                      id="machineHourDelete{{ $row->id }}" display="none">
                      @csrf @method('DELETE')
                    </form>
                    <button type="submit" class="dropdown-item"
                      wire:click="removeRegister('/cultive/machine-hours', {{ $row->id }})"><i
                        class="bx bx-trash me-1"></i>
                      Remover</button>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
