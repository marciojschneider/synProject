{{-- Listagem --}}
<div class="card g-3 mt-1">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Roadmap</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
        {{-- Select registros por página --}}
        <div class="dataTables_length" style="margin-right: 5px;">
          <select wire:model.live.click="pPage" class="form-select">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
          </select>
        </div>

        {{-- Busca por módulos --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="sidebar" id="sidebar" name="sidebar" class="form-select">
            <option value="" selected> Módulo </option>
            @foreach ($sidebars as $sidebar)
              <option value="{{ $sidebar->id }}">{{ $sidebar->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Busca por situação --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <select wire:model.live.click="situation" id="situation" name="situation" class="form-select">
            <option value="" selected> Situação </option>
            <option value="1">SOLICITADO</option>
            <option value="2">EM DESENVOLVIMENTO</option>
            <option value="3">PENDENTE</option>
            <option value="4">APROVADO</option>
            <option value="5">INATIVO</option>
          </select>
        </div>

        {{-- Caixa de pesquisa --}}
        <div id="DataTables_Table_0_filter" class="dataTables_filter" bis_skin_checked="1" style="margin-right: 5px;">
          <label><input wire:model.live.debounce.500ms="searchText" type="search" class="form-control"
              placeholder="Buscar..." aria-controls="DataTables_Table_0"></label>
        </div>

        {{-- Botão de novo usuário --}}
        <div class="dt-buttons" bis_skin_checked="1">
          <a class="dt-button add-new btn btn-primary" href="{{ route('sup-task-create') }}"><span> <i
                class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Novo</span>
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
        </thead>
        <tbody class="table-border-bottom-0">
          <div class="accordion stick-top accordion-bordered" id="courseContent">
            {{-- Inicio do item --}}
            @if (count($rows) > 0)
              @foreach ($rows as $row)
                <div class="accordion-item shadow-none border mb-0">
                  <div class="accordion-header" id="headingOne">
                    {{-- TODO Arrumar a cor dos botões para que fique padrão conforme o estilo da pagina. --}}
                    <div class="d-flex flex-row align-items-center">
                      @if ($row->situation < 4)
                        <div class="bg-lighter" style="padding: 11.5 0 11.5 11.5">
                          <a class="add-new btn btn-outline-primary h-25 align-content-center p-3"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddRoadmap"
                            onclick="newModal({{ $row->id }})" href="#"> <i class="bx bx-plus"></i>
                          </a>
                        </div>
                      @endif
                      <button type="button" class="bg-lighter rounded-0 accordion-button collapsed"
                        data-bs-toggle="collapse" data-bs-target="#chapter{{ $row->id }}" aria-expanded="false"
                        aria-controls="chapter{{ $row->id }}">
                        <div class="d-flex flex-row">

                          <div class="d-flex flex-column" style="margin-left: 5px;">
                            <span class="h5 mb-1">{{ $row->title }}
                              <div class="badge bg-secondary rounded-pill ms-auto" bis_skin_checked="1">
                                {{ $row->sName }}
                              </div>
                              <div class="badge bg-{{ $row->cSituation }} rounded-pill ms-auto" bis_skin_checked="1">
                                {{ $row->nSituation }}
                              </div>
                            </span>
                            <span class="fw-normal">
                              Inicio: {{ date('d/m/Y', strtotime($row->initial_dt)) }} |
                              Expectativa: {{ date('d/m/Y', strtotime($row->expected_dt)) }}
                            </span>
                          </div>
                        </div>
                      </button>
                    </div>
                  </div>
                  <div id="chapter{{ $row->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#courseContent">
                    @foreach ($row->details as $detail)
                      <div class="accordion-body py-3 border-top">
                        <div class="d-flex">
                          {{-- <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" /> --}}
                          <label for="defaultCheck1" class="form-check-label col-md-10">
                            <span class="mb-0 h6">Detalhamento: {{ $detail->description }}</span>
                            <span class="text-muted d-block">Commit: {{ $detail->commit_reference }}</span>
                            <span class="text-muted d-block">Inicio:
                              {{ date('d/m/Y H:i:s', strtotime($detail->initial_dt)) }}
                              | Fim:
                              {{ date('d/m/Y H:i:s', strtotime($detail->ending_dt)) }}</span>
                          </label>
                          @if ($row->situation < 4)
                            {{-- Botões de ação --}}
                            <form method="POST" action="{{ route('sup-roadmap-delete', $detail->id) }}"
                              id="roadmapDelete{{ $detail->id }}" display="none">
                              @csrf
                            </form>
                            <div class="d-flex flex-row-reverse col-md-2">
                              <a class="btn btn-outline-danger m-1" onclick="removeModal({{ $detail->id }})"
                                href="#"> <i class="bx bx-trash"></i>
                              </a>
                              <a class="btn btn-outline-warning m-1" onclick="updateModal({{ $detail }})"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpdateRoadmap" href="#">
                                <i class="bx bx-edit-alt"></i>
                              </a>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
            @else
              <span>Não hà registros</span>
            @endif
            {{-- Fim do item --}}
          </div>
        </tbody>
      </table>
      <div class="mt-4"> {{ $rows->links() }} </div>
    </div>
  </div>
</div>
