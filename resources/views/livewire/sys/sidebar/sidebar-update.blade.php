<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Módulo /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>
          <div class="col-md-3">
            <label for="icon" class="form-label">Icone</label>
            <input type="text" class="form-control" wire:model="icon" />
          </div>
          <div class="col-md-3">
            <label for="slug" class="form-label">Apelido</label>
            <input type="text" class="form-control" wire:model="slug" required />
          </div>
          <div class="col-md-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" class="form-control" wire:model="url" />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="module" class="form-label">Afiliado</label>
            <div id="moduleContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="module" id="module" name="module" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#moduleContainer">
                <option value="0"> PRINCIPAL </option>
                @foreach ($modules as $module)
                  <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="client" class="form-label">Cliente</label>
            <div id="clientContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="client" id="client" name="client" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar"
                data-container="#clientContainer" multiple>
                @foreach ($clients as $client)
                  <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="order" class="form-label">Ordem</label>
            <input type="text" class="form-control" wire:model="order" />
          </div>

          <div class="col-md-3">
            <label for="visualization" class="form-label">Visualização</label>
            <div id="visualizationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="visualization" id="visualization" name="visualization" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#visualizationContainer">
                <option value="1">VISÍVEL</option>
                <option value="2">OCULTA</option>
              </select>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-sidebars') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
