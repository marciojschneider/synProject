<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Grupos</h5>
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
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <label><input wire:model.live.debounce.500ms="searchText" type="search" class="form-control"
              placeholder="Buscar..." aria-controls="DataTables_Table_0"></label>
        </div>

        {{-- Botão de novo usuário --}}
        <div class="dt-buttons" bis_skin_checked="1">
          <a class="dt-button add-new btn btn-primary" href="{{ route('cultive-group-create') }}"><span> <i
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
            <th>Código</th>
            <th>Nome</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ $row->code }}</td>
                <td>{{ $row->name }}</td>
                <td><span
                    class="badge {{ $row->situation == 1 ? 'bg-label-primary' : 'bg-label-warning' }} me-1">{{ $row->situation == 1 ? 'ATIVO' : 'INATIVO' }}</span>
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                        class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('cultive-group-update', $row->id) }}"><i
                          class="bx bx-edit-alt me-1"></i> Editar</a>

                      <form method="POST" action="{{ route('cultive-group-delete', $row->id) }}"
                        id="groupDelete{{ $row->id }}" display="none">
                        @csrf @method('DELETE')
                      </form>
                      <button type="submit" class="dropdown-item"
                        wire:click="removeRegister('/cultive/groups', {{ $row->id }})"><i
                          class="bx bx-trash me-1"></i>
                        Remover</button>
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
