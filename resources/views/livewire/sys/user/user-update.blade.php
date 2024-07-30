<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Usuário /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" required />
            @error('name')
              <span class="error"> {{ $message }} </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" wire:model="email" required />
            @error('email')
              <span class="error"> {{ $message }} </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="password" class="form-label">Senha</label>
            <input type="text" class="form-control" wire:model="password" />
            @error('password')
              <span class="error"> {{ $message }} </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select">
              <option value="2">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-users') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
