<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Cultivo / Variedade /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" required />
          </div>

          <div class="col-md-4">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <div id="cultureContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="culture" id="culture" name="culture" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#cultureContainer">
                @foreach ($cultures as $culture)
                  <option value="{{ $culture->id }}"> {{ $culture->code }} - {{ $culture->name }} </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="group" class="form-label">Grupo</label>
            <div id="groupContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="group" id="group" name="group" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#groupContainer">
                @foreach ($groups as $group)
                  <option value="{{ $group->id }}"> {{ $group->code }} - {{ $group->name }} </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
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
        <a href="{{ route('cultive-varieties') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
