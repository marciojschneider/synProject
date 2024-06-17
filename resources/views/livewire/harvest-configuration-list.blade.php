<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Configurações Safra</h5>
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

        {{-- Busca por safras --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="harvest" id="harvest" name="harvest" class="form-select">
            <option value="" selected> Safra </option>
            @foreach ($harvests as $harvest)
              <option value="{{ $harvest->id }}">{{ $harvest->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por secções --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="section" id="section" name="section" class="form-select">
            <option value="" selected> Secções </option>
            @foreach ($sections as $section)
              <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por talhões --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="field" id="field" name="field" class="form-select">
            <option value="" selected> Talhões </option>
            @foreach ($fields as $field)
              <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por culturas --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="culture" id="culture" name="culture" class="form-select">
            <option value="" selected> Culturas </option>
            @foreach ($cultures as $culture)
              <option value="{{ $culture->id }}">{{ $culture->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Botão de novo usuário --}}
        <div class="dt-buttons" bis_skin_checked="1">
          <a class="dt-button add-new btn btn-primary" href="{{ route('harv-configuration-create') }}"><span> <i
                class="bx bx-plus me-0 me-sm-1"></i> <span class="d-none d-sm-inline-block">Novo</span>
            </span>
          </a>
        </div>
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
            <th>Estabelecimento</th>
            <th>Área Plantio</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($rows as $row)
            <tr>
              <td>{{ $row->cHarvest }}</td>
              <td>{{ $row->nSection }}</td>
              <td>{{ $row->nField }}</td>
              <td>{{ $row->nCulture }}</td>
              <td>{{ $row->nVariety }}</td>
              <td>{{ $row->nPlantingMethod }}</td>
              <td>{{ $row->nOrganization }}</td>
              <td>{{ number_format(floatval($row->planting_area), 0, ',', '.') }}</td>
              <td><span
                  class="badge {{ $row->situation == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">{{ $row->situation == 1 ? 'Aberto' : 'Fechado' }}</span>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                      class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('harv-configuration-update', $row->id) }}"><i
                        class="bx bx-edit-alt me-1"></i> Editar</a>

                    <form method="POST" action="{{ route('harv-configuration-delete', $row->id) }}"
                      id="harvestConfigurationDelete{{ $row->id }}" display="none">
                      @csrf
                    </form>
                    <button type="submit" class="dropdown-item" onclick="removeModal({{ $row->id }})"><i
                        class="bx bx-trash me-1"></i> Remover</button>
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
    document.getElementById('harvestConfigurationDelete' + id).submit();
  }
</script>
