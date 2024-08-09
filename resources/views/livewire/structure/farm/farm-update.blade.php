<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Estrutura / Fazenda /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" required />
          </div>

          <div class="col-md-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>

          <div class="col-md-2">
            <label for="property" class="form-label">Propriedade</label>
            <div id="propertyContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="property" id="property" name="property" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#propertyContainer">
                <option value="2">TERCEIRO</option>
                <option value="1" selected>PRÓPRIO</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="owner" class="form-label">Proprietário</label>
            <div id="ownerContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="owner" id="owner" name="owner" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#ownerContainer">
                <option value="1" selected>2 - GRANJAS BRETANHAS S.A.</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
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
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('structure-farms') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
