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
            <select wire:model="harvest" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($harvests as $harvest)
                <option value="{{ $harvest->id }}">{{ $harvest->code }} - {{ $harvest->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="section" class="form-label">Secção</label>
            <select wire:model="section" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($sections as $section)
                <option value="{{ $section->id }}">{{ $section->code }} - {{ $section->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="field" class="form-label">Talhão</label>
            <select wire:model="field" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($fields as $field)
                <option value="{{ $field->id }}">{{ $field->code }} - {{ $field->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <select wire:model="culture" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($cultures as $culture)
                <option value="{{ $culture->id }}">{{ $culture->code }} - {{ $culture->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="variety" class="form-label">Variedade</label>
            <select wire:model="variety" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($varieties as $variety)
                <option value="{{ $variety->id }}">{{ $variety->code }} - {{ $variety->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="planting_method" class="form-label">Método Plantio</label>
            <select wire:model="planting_method" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($planting_methods as $planting_method)
                <option value="{{ $planting_method->id }}">{{ $planting_method->code }} -
                  {{ $planting_method->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="planting_area" class="form-label">Área Plantio</label>
            <input type="text" class="form-control" wire:model="planting_area" placeholder="0.000,00" required />
          </div>

          <div class="col-md-4">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select" required>
              <option value="0">FECHADO</option>
              <option value="1" selected>ABERTO</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="organization" class="form-label">Estabelecimento</label>
            <select wire:model="organization" class="form-select" required>
              <option value="" selected> SELECIONAR </option>
              @foreach ($organizations as $organization)
                <option value="{{ $organization->id }}">{{ $organization->code }} - {{ $organization->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('harv-configurations') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
