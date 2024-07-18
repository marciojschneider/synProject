<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Segurança / Permissão /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="module" class="form-label">Módulo</label>
            <select class="form-select" wire:model.live="module" required>
              <option value="">SELECIONAR</option>
              @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="screen" class="form-label">Tela</label>
            <select wire:model="screen" class="form-select" required>
              <option value="">SELECIONAR</option>
              @foreach ($screens as $screen)
                <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="profile" class="form-label">Perfil</label>
            <select wire:model="profile" class="form-select" required>
              <option value="">SELECIONAR</option>
              @foreach ($profiles as $profile)
                <option value="{{ $profile->id }}">{{ mb_strtoupper($profile->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select">
              <option value="0">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control"
              placeholder="Anotações sobre o motivo das permissões serem consedidas ao perfil em questão." wire:model="description"
              maxlength="250" rows="4"></textarea>
          </div>
        </div>

        <!-- Permission table -->
        <div class="row mb-4">
          <div class="d-flex justify-content-between">
            <span class="text-nowrap fw-medium">Permissões <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Selecione as permissões do perfil diante ao módulo"></i>
            </span>

            <div class="form-check ">
              <input class="form-check-input" type="checkbox" wire:model="viewCheck" />
              <label class="form-check-label" for="viewCheck">
                Listagem
              </label>
            </div>

            <div class="form-check ">
              <input class="form-check-input" type="checkbox" wire:model="createCheck" />
              <label class="form-check-label" for="createCheck">
                Criação
              </label>
            </div>

            <div class="form-check ">
              <input class="form-check-input" type="checkbox" wire:model="updateCheck" />
              <label class="form-check-label" for="updateCheck">
                Edição
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" wire:model="deleteCheck" />
              <label class="form-check-label" for="deleteCheck">
                Remoção
              </label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-sec-permissions') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
