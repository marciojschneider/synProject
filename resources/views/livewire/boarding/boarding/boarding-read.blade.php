<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Embarques / Embarque /</span> Leitura
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="number" class="form-label">Embarque</label>
            <input type="text" class="form-control" wire:model="number" disabled />
          </div>

          <div class="col-md-2">
            <label for="request" class="form-label">Pedido</label>
            <input type="text" class="form-control" wire:model="request" disabled />
          </div>

          <div class="col-md-2">
            <label for="date" class="form-label">Entrega</label>
            <input type="date" class="form-control" wire:model="date" disabled />
          </div>

          <div class="col-md-3">
            <label for="separador" class="form-label">Separador</label>
            <input type="text" class="form-control" wire:model="separador" disabled />
          </div>

          <div class="col-md-3">
            <label for="situation" class="form-label">Situação</label>
            <input type="text" class="form-control" wire:model="situation" disabled />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-12">
            <label for="codeRead" class="form-label">Código</label>
            <input type="text" class="form-control" wire:model.live.debounce.500ms="codeRead" autofocus
              @if ($situation == 'FINALIZADO') disabled @endif />
          </div>
        </div>

        <div class="row mb-4">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Qtd.</th>
                  <th>Deposito</th>
                  <th>Localização</th>
                  <th>Máxima</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($rows as $row)
                  <tr>
                    <td>{{ $row->item_code }}</td>
                    <td>{{ $row->item_desc }}</td>
                    <td>{{ round($row->box) }}</td>
                    <td>{{ $row->deposit }}</td>
                    <td>{{ $row->location }}</td>
                    <td>{{ $row->item_amount }}</td>
                    <td>{{ $row->read_amount }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <a href="{{ route('boar-boardings') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
