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
            <select wire:model="property" class="form-select" required>
              <option value="0">TERCEIRO</option>
              <option value="1" selected>PRÓPRIO</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="owner" class="form-label">Proprietário</label>
            <select wire:model="owner" class="form-select" required>
              <option value="1" selected>2 - GRANJAS BRETANHAS S.A.</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select" required>
              <option value="0">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('structure-farms') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
