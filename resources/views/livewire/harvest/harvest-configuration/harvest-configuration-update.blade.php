<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Safra / Configuração Safra /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="harvest" class="form-label">Safra</label>
            <div id="harvestContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="harvest" id="harvest" name="harvest" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#harvestContainer">
                @foreach ($harvests as $harvest)
                  <option value="{{ $harvest->id }}">{{ $harvest->code }} - {{ $harvest->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="section" class="form-label">Secção</label>
            <div id="sectionContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="section" id="section" name="section" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#sectionContainer">
                @foreach ($sections as $section)
                  <option value="{{ $section->id }}">{{ $section->code }} - {{ $section->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="field" class="form-label">Talhão</label>
            <div id="fieldContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="field" id="field" name="field" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#fieldContainer">
                @foreach ($fields as $field)
                  <option value="{{ $field->id }}">{{ $field->code }} - {{ $field->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <div id="cultureContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="culture" id="culture" name="culture" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#cultureContainer">
                @foreach ($cultures as $culture)
                  <option value="{{ $culture->id }}">{{ $culture->code }} - {{ $culture->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="variety" class="form-label">Variedade</label>
            <div id="varietyContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="variety" id="variety" name="variety" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#varietyContainer">
                @foreach ($varieties as $variety)
                  <option value="{{ $variety->id }}">{{ $variety->code }} - {{ $variety->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="planting_method" class="form-label">Método Plantio</label>
            <div id="planting_methodContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="planting_method" id="planting_method" name="planting_method"
                class="selectpicker col-sm-12" data-style="btn-default" data-live-search="true" placeholder="SELECIONAR"
                required data-container="#planting_methodContainer">
                @foreach ($planting_methods as $planting_method)
                  <option value="{{ $planting_method->id }}">{{ $planting_method->code }} -
                    {{ $planting_method->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="planting_area" class="form-label">Área Plantio</label>
            <input type="text" class="form-control" wire:model="planting_area" placeholder="0.000,00" required />
          </div>

          <div class="col-md-4">
            <label for="situation" class="form-label">Situação</label>
            <div id="situationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="situation" id="situation" name="situation" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#situationContainer">
                <option value="1">ATIVO</option>
                <option value="2">INATIVO</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="organization" class="form-label">Organização</label>
            <div id="organizationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="organization" id="organization" name="organization" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#organizationContainer">
                @foreach ($organizations as $organization)
                  <option value="{{ $organization->id }}">{{ $organization->code }} - {{ $organization->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('harv-configurations') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
