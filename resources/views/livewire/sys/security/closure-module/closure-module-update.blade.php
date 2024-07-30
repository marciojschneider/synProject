<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Segurança / Fechamento /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="module" class="form-label">Módulo</label>
            <select class="form-select" wire:model.live="module"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="screen" class="form-label">Tela</label>
            <select wire:model="screen" class="form-select" required>
              @foreach ($screens as $screen)
                <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="ending_dt" class="form-label">Fechamento</label>
            <input type="date" step="1" class="form-control" wire:model="dt_closure" required />
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select" required>
              <option value="2">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-sec-closures') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
