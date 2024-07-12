<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Cultivo / Método /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" />
          </div>

          <div class="col-md-4">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" />
          </div>

          <div class="col-md-4">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select">
              <option value="0">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('cultive-methods') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
