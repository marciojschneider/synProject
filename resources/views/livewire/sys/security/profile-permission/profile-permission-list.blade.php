<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Permissões</h5>
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
          <a class="dt-button add-new btn btn-primary" href="{{ route('sys-sec-permission-create') }}"><span> <i
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
      {{-- Busca por módulo --}}
      <div id="moduleContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model.live.click="module" id="module" name="module" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Módulo" data-container="#moduleContainer">
          @foreach ($modules as $module)
            <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Tela --}}
      <div id="screenContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="screen" id="screen" name="screen" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Tela" data-container="#screenContainer">
          @if (!$screens)
            <option disabled> SEM REGISTROS </option>
          @endif

          @foreach ($screens as $screen)
            <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
          @endforeach
        </select>
      </div>

      {{-- Busca por Perfil --}}
      <div id="profileContainer" class="dataTables_filter mb-4" bis_skin_checked="1" wire:ignore>
        <select wire:model="profile" id="profile" name="profile" class="selectpicker col-sm-12"
          data-style="btn-default" data-live-search="true" placeholder="Perfil" data-container="#profileContainer">
          @foreach ($profiles as $profile)
            <option value="{{ $profile->id }}">{{ mb_strtoupper($profile->name, 'UTF-8') }}</option>
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
            <th>Módulo</th>
            <th>Perfil</th>
            <th>Visualização</th>
            <th>Criação</th>
            <th>Edição</th>
            <th>Exclusão</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if (count($rows) > 0)
            @foreach ($rows as $row)
              <tr>
                <td>{{ mb_strtoupper($row->sName, 'UTF-8') }} </td>
                <td>{{ $row->pName }}</td>
                {{-- <td>{{ $row->description }}</td> --}}
                <td><span
                    class="badge {{ $row->view == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">{{ $row->view == 1 ? 'Permitido' : 'Não permitido' }}</span>
                </td>
                <td><span
                    class="badge {{ $row->create == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">{{ $row->create == 1 ? 'Permitido' : 'Não permitido' }}</span>
                </td>
                <td><span
                    class="badge {{ $row->update == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">{{ $row->update == 1 ? 'Permitido' : 'Não permitido' }}</span>
                </td>
                <td><span
                    class="badge {{ $row->delete == 1 ? 'bg-label-primary' : 'bg-label-danger' }} me-1">{{ $row->delete == 1 ? 'Permitido' : 'Não permitido' }}</span>
                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                        class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('sys-sec-permission-update', $row->id) }}"><i
                          class="bx bx-edit-alt me-1"></i> Editar</a>

                      <form method="POST" action="{{ route('sys-sec-permission-delete', $row->id) }}"
                        id="permissionDelete{{ $row->id }}" display="none">
                        @csrf
                      </form>
                      <button type="submit" class="dropdown-item" onclick="removeModal({{ $row->id }})"><i
                          class="bx bx-trash me-1"></i> Remover</button>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="7">Não hà registros</td>
            </tr>
          @endif
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
