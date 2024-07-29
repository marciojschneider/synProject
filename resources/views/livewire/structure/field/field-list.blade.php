<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Talhões</h5>
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
                class='bx bx-search-alt-2'></i> <span class="d-none d-sm-inline-block">Busca avançada</span>
            </span>
          </a>
          <a class="dt-button add-new btn btn-primary" href="{{ route('structure-field-create') }}"><span> <i
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
    <div class="offcanvas-body mx-0 flex-grow-0">
      {{-- Busca por Fazenda --}}
      <div id="DataTables_Table_0_filter" class="dataTables_filter mb-4" bis_skin_checked="1">
        <select wire:model="farm" class="form-select">
          <option value="" selected> FAZENDA </option>
          @foreach ($farms as $farm)
            <option value="{{ $farm->id }}"> {{ $farm->code }} - {{ mb_strtoupper($farm->name, 'UTF-8') }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Localidade --}}
      <div id="DataTables_Table_0_filter" class="dataTables_filter mb-4" bis_skin_checked="1">
        <select wire:model="locality" class="form-select">
          <option value="" selected> LOCALIDADE </option>
          @foreach ($localities as $locality)
            <option value="{{ $locality->id }}">{{ $locality->code }} - {{ mb_strtoupper($locality->name, 'UTF-8') }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <button wire:click="search" class="btn btn-success">Buscar</button>
        <button wire:click="clean" class="btn btn-danger">Limpar</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Fechar</button>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Fazenda</th>
            <th>Área Total</th>
            <th>Área Produtiva</th>
            <th>Grupo Local</th>
            <th>Localidade</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($rows as $row)
            <tr>
              <td>{{ $row->code }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->cFarm }} - {{ $row->nFarm }} </td>
              <td>{{ $row->total_area }}</td>
              <td>{{ $row->productive_area }}</td>
              <td>{{ $row->local_group }}</td>
              <td>{{ $row->cLocality }} - {{ $row->nLocality }} </td>
              <td><span
                  class="badge {{ $row->situation == 1 ? 'bg-label-primary' : 'bg-label-warning' }} me-1">{{ $row->situation == 1 ? 'ATIVO' : 'INATIVO' }}</span>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                      class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('structure-field-update', $row->id) }}"><i
                        class="bx bx-edit-alt me-1"></i> Editar</a>

                    <form method="POST" action="{{ route('structure-field-delete', $row->id) }}"
                      id="fieldDelete{{ $row->id }}" display="none">
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
    document.getElementById('fieldDelete' + id).submit();
  }
</script>
