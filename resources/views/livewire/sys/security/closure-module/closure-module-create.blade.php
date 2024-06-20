<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Fechamentos /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form method="POST" action="{{ route('sys-sec-closure-create') }}">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="module" class="form-label">Módulo</label>
            <select id="module" name="module" class="form-select" wire:model.live="module">
              @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="screen" class="form-label">Tela</label>
            <select id="screen" name="screen" class="form-select">
              @foreach ($screens as $screen)
                <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="ending_dt" class="form-label">Fechamento</label>
            <input type="datetime-local" step="1" class="form-control" id="dt_closure" name="dt_closure"
              value="{{ date('Y-m-d', strtotime(now('America/Sao_Paulo'))) }}" />
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <select id="situation" name="situation" class="form-select">
              <option value="0">Inativo</option>
              <option value="1" selected>Ativo</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-sec-closures') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
