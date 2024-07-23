<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Estrutura / Talhão /</span> Cadastrar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model="code" maxlength="50" required />
          </div>

          <div class="col-md-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" wire:model="name" maxlength="50" required />
          </div>

          <div class="col-md-3">
            <label for="farm" class="form-label">Fazenda</label>
            <select wire:model="farm" class="form-select" required>
              <option value="">SELECIONAR</option>
              @foreach ($farms as $farm)
                <option value="{{ $farm->id }}"> {{ $farm->code }} - {{ $farm->name }} </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label for="locality" class="form-label">Localidade</label>
            <select wire:model="locality" class="form-select" required>
              <option value="">SELECIONAR</option>
              @foreach ($localities as $locality)
                <option value="{{ $locality->id }}"> {{ $locality->code }} - {{ $locality->name }} </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="total_area" class="form-label">Área Total</label>
            <input type="text" class="form-control" wire:model="total_area" placeholder="0.000,00" required />
          </div>

          <div class="col-md-3">
            <label for="productive_area" class="form-label">Área Produtiva</label>
            <input type="text" class="form-control" wire:model="productive_area" placeholder="0.000,00" required />
          </div>

          <div class="col-md-2">
            <label for="property_registration" class="form-label">Mátricula</label>
            <input type="text" class="form-control" wire:model="property_registration" maxlength="50" />
          </div>

          <div class="col-md-2">
            <label for="local_group" class="form-label">Grupo</label>
            <input type="text" class="form-control" wire:model="local_group" maxlength="50" />
          </div>

          <div class="col-md-2">
            <label for="situation" class="form-label">Situação</label>
            <select wire:model="situation" class="form-select">
              <option value="0">INATIVO</option>
              <option value="1">ATIVO</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('structure-fields') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
