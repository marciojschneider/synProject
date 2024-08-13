<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Sistema / Segurança / Fechamento /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="module" class="form-label">Módulo</label>
            <div id="moduleContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model.live.click="module" id="module" name="module" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#moduleContainer">
                @foreach ($modules as $module)
                  <option value="{{ $module->id }}">{{ mb_strtoupper($module->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="screen" class="form-label">Tela</label>
            <div id="screenContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="screen" id="screen" name="screen" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#screenContainer">
                @if (!$screens)
                  <option disabled> SEM REGISTROS </option>
                @endif

                @foreach ($screens as $screen)
                  <option value="{{ $screen->id }}">{{ mb_strtoupper($screen->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="ending_dt" class="form-label">Fechamento</label>
            <input type="date" step="1" class="form-control" wire:model="dt_closure" required />
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <div id="situationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="situation" id="situation" name="situation" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#situationContainer">
                <option value="1">ATIVO</option>
                <option value="2">INATIVO</option>
              </select>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('sys-sec-closures') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
