<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Chamados /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form method="POST" action="{{ route('sup-task-update', $task->id) }}">
        @csrf
        <div class="row mb-4">
          <div class="col-md-2">
            <label for="name" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" maxlength="50"
              value="{{ $task->title }}" />
          </div>

          <div class="col-md-2">
            <label for="module" class="form-label">Módulo</label>
            <select id="module" name="module" class="form-select" wire:model.live="module">
              @foreach ($modules as $module)
                <option value="{{ $module->id }}" {{ str_contains($task->module, $module->id) ? 'selected' : '' }}>
                  {{ mb_strtoupper($module->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="screen" class="form-label">Tela</label>
            <select id="screen" name="screen" class="form-select">
              @foreach ($screens as $screen)
                <option value="{{ $screen->id }}"
                  {{ str_contains($task->sidebar_id, $screen->id) ? 'selected' : '' }}>
                  {{ mb_strtoupper($screen->name, 'UTF-8') }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="situation" class="form-label">Situação</label>
            <select id="situation" name="situation" class="form-select">
              <option value="1" {{ $task->situation == 1 ? 'selected' : '' }}>SOLICITADO</option>
              <option value="2" {{ $task->situation == 2 ? 'selected' : '' }}>EM DESENVOLVIMENTO</option>
              <option value="3" {{ $task->situation == 3 ? 'selected' : '' }}>PENDENTE</option>
              <option value="4">APROVADO</option>
              <option value="5">INATIVO</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="solicitation" class="form-label">Solicitação</label>
            <input class="form-control" type="datetime-local" step="1" value="{{ $task->initial_dt }}" readonly
              id="solicitation" name="solicitation" onchange="updateData()" />
          </div>

          <div class="col-md-2">
            <label for="expectation" class="form-label">Expectativa</label>
            <input class="form-control" type="datetime-local" step="1" value="{{ $task->expected_dt }}"
              id="expectation" name="expectation" />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <label for="defaultSelect" class="form-label">Descrição</label>
            <textarea class="form-control" placeholder="Descreva o que precisa ser feito no chamado em questão." id="description"
              name="description" maxlength="250" rows="4"> {{ $task->description }} </textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sup-tasks') }}" class="btn btn-secondary">Voltar</a>
        <a class="btn btn-danger" onclick="removeModal({{ $task->id }})" href="#">Excluir</a>
      </form>

      <form method="POST" id="deleteForm{{ $task->id }}" action="{{ route('sup-task-delete', $task->id) }}">
        @csrf
      </form>
    </div>
  </div>
</div>
