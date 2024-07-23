<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Hora Máquinas</h5>
    </div>
    <div class="col-md-10 mb-2" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">

        {{-- Caixa de pesquisa --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <label><input wire:model.live.debounce.500ms="searchText" type="search" class="form-control"
              placeholder="Buscar..." aria-controls="DataTables_Table_0"></label>
        </div>

        {{-- Botão de novo usuário --}}
        <div class="dt-buttons" bis_skin_checked="1">
          <a class="dt-button add-new btn btn-primary" href="{{ route('cultive-machine-hour-create') }}"><span> <i
                class="bx bx-plus me-0 me-sm-1"></i> <span class="d-none d-sm-inline-block">Novo</span>
            </span>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-12" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end  flex-md-row flex-column">
        {{-- Busca por organização --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="organization" class="form-select">
            <option value="" selected> ORGANIZAÇÃO </option>
            @foreach ($organizations as $organization)
              <option value="{{ $organization->id }}">{{ $organization->code }} -
                {{ mb_strtoupper($organization->name, 'UTF-8') }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por Safra --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="harvest" class="form-select">
            <option value="" selected> SAFRA </option>
            @foreach ($harvests as $harvest)
              <option value="{{ $harvest->id }}">{{ $harvest->code }} -
                {{ mb_strtoupper($harvest->name, 'UTF-8') }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por organização --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="section" class="form-select">
            <option value="" selected> SECÇÃO </option>
            @foreach ($sections as $section)
              <option value="{{ $section->id }}">{{ $section->code }} -
                {{ mb_strtoupper($section->name, 'UTF-8') }}</option>
            @endforeach
          </select>
        </div>

        {{-- Select registros por página --}}
        <div class="dataTables_length" style="margin-right: 5px;">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
        </div>
        {{-- Busca por organização --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="organization" class="form-select">
            <option value="" selected> TALHÃO </option>
            @foreach ($fields as $field)
              <option value="{{ $field->id }}">{{ $field->code }} -
                {{ mb_strtoupper($field->name, 'UTF-8') }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por Processo --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="organization" class="form-select">
            <option value="" selected> PROCESSO </option>
            @foreach ($processes as $process)
              <option value="{{ $process->id }}">{{ $process->code }} -
                {{ mb_strtoupper($process->name, 'UTF-8') }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por Equipamento --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="equipament" class="form-select">
            <option value="" selected> EQUIPAMENTO </option>
            <option value="1">EQUIPAMENTO FICTICIO 01</option>
            <option value="2">EQUIPAMENTO FICTICIO 02</option>
          </select>
        </div>

        {{-- Busca por Implemento --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1">
          <select wire:model.live.click="implement" class="form-select">
            <option value="" selected> IMPLEMENTO </option>
            <option value="1">IMPLEMENTO FICTICIO 01</option>
            <option value="2">IMPLEMENTO FICTICIO 02</option>
          </select>
        </div>
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
              <td>{{ $row->cProcess }} - {{ $row->nSection }}</td>
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
                    <button type="submit" class="dropdown-item" onclick="removeModal({{ $row->id }})">
                      <i class="bx bx-trash me-1"></i> Remover
                    </button>
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

<script>
  function removeModal(id) {
    Swal.fire({
      title: 'Você tem certeza?',
      text: "Essa ação não será revertida!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, deletar isso!',
      cancelButtonText: 'Cancelar',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function(result) {
      if (result.value) {
        Swal.fire({
          icon: 'success',
          title: 'Deletado!',
          text: 'O registro foi removido do sistema.',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        }).then(function(result) {
          sendDelete(id)
        });
      }
    });
  }

  function sendDelete(id) {
    document.getElementById('machineHourDelete' + id).submit();
  }
</script>
