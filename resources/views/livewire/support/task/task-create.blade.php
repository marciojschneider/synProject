<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Chamados /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form method="POST" action="{{ route('sup-task-create') }}">
        @csrf
        <div class="row mb-4">
          <div class="col-md-2">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" maxlength="50" />
          </div>

          <div class="col-md-2">
            <label for="module" class="form-label">Módulo</label>
            <select id="module" name="module" class="form-select" wire:model.live="module">
              @foreach ($modules as $module)
                <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="screen" class="form-label">Tela</label>
            <select id="screen" name="screen" class="form-select">
              @foreach ($screens as $screen)
                <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="situation" class="form-label">Situação</label>
            <select id="situation" name="situation" class="form-select">
              <option value="1">Solicitado</option>
              <option value="2">Em desenvolvimento</option>
              <option value="3">Pendente</option>
              <option value="4">Aprovado</option>
              <option value="5">Inativo</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="solicitation" class="form-label">Solicitação</label>
            <input class="form-control" type="datetime-local"
              step="1"value="{{ date('Y-m-d H:i:s', strtotime(now('America/Sao_Paulo'))) }}" id="solicitation"
              name="solicitation" onchange="updateData()" />
          </div>

          <div class="col-md-2">
            <label for="expectation" class="form-label">Expectativa</label>
            <input class="form-control" type="datetime-local" step="1"
              value="{{ date('Y-m-d H:i:s', strtotime('+2 days', strtotime(now('America/Sao_Paulo')))) }}" readonly
              id="expectation" name="expectation" />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
              name="description" maxlength="250" rows="4"></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sup-tasks') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
