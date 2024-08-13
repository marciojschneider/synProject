<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Safra / Safra /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" required />
          </div>

          <div class="col-md-4">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>

          <div class="col-md-4">
            <label for="price_table" class="form-label">Preço</label>
            <div id="price_tableContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="price_table" id="price_table" name="price_table" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#price_tableContainer">
                <option value="0">FICTÍCIO</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="ending_dt" class="form-label">Início</label>
            <input type="date" step="1" class="form-control" wire:model="initial_dt" required />
          </div>

          <div class="col-md-4">
            <label for="ending_dt" class="form-label">Fim</label>
            <input type="date" step="1" class="form-control" wire:model="ending_dt"
              value="{{ date('Y-m-d', strtotime(now('America/Sao_Paulo'))) }}" required />
          </div>

          <div class="col-md-4">
            <label for="situation" class="form-label">Situação</label>
            <div id="situationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="situation" id="situation" name="situation" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#situationContainer">
                <option value="1">ATIVO</option>
                <option value="2">INATIVO</option>
              </select>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('harv-harvests') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
