<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Segurança / Perfil de Usuário /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="user" class="form-label">Usuário</label>
            <div id="userContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model.live.click="user" id="user" name="user" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#userContainer">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="profile" class="form-label">Perfil</label>
            <div id="profileContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model.live.click="profile" id="profile" name="profile" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#profileContainer">
                @foreach ($profiles as $profile)
                  <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="module" class="form-label">Situação</label>
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
        <a href="{{ route('sys-sec-u-ps') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
