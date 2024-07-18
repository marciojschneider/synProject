<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Segurança / Perfil de Usuário /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="user" class="form-label">Usuário</label>
            <select wire:model="user" class="form-select" required>
              <option value=""> SELECIONAR </option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label for="profile" class="form-label">Perfil</label>
            <select wire:model="profile" class="form-select" required>
              <option value=""> SELECIONAR </option>
              @foreach ($profiles as $profile)
                <option value="{{ $profile->id }}">{{ $profile->name }}</option>
              @endforeach
            </select>
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
        <a href="{{ route('sys-sec-u-ps') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
