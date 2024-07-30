<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Perfil /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>

          <div class="col-md-4">
            <label for="client" class="form-label">Cliente</label>
            <select wire:model="client" class="form-select" required>
              @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select">
              <option value="2">INATIVO</option>
              <option value="1" selected>ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-profiles') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
