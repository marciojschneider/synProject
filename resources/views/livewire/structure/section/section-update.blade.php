<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Estrutura / Secção /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-6">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" required />
          </div>

          <div class="col-md-6">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>
        </div>

        <div class="row mb-4">

          <div class="col-md-4">
            <label for="organization" class="form-label">Organização</label>
            <div id="organizationContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="organization" id="organization" name="organization" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#organizationContainer">
                @foreach ($organizations as $organization)
                  <option value="{{ $organization->id }}"> {{ $organization->code }} - {{ $organization->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <label for="responsible" class="form-label">Responsável</label>
            <div id="responsibleContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="responsible" id="responsible" name="responsible" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="Selecionar" required
                data-container="#responsibleContainer">
                <option value="8">2 - GRANJA BRETANHAS S.A.</option>
                <option value="130">6157 - ADELSON CESAR PORTO CARDOSO</option>
                <option value="154">6082 - JAQUES LAGES DUTRA</option>
                <option value="158">6044 - JOSE PAULO LIMA</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
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
        <a href="{{ route('structure-sections') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
