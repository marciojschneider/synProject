<div class="card">
  <div class="row card-header" bis_skin_checked="1" style="align-items: center">
    <div class="col-md-2">
      <h5>Embarques</h5>
    </div>
    <div class="col-md-10" bis_skin_checked="1">
      <div
        class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">

        {{-- Botões --}}
        <div class="dt-buttons" bis_skin_checked="1" style="margin-left: 5px; margin-right: 5px; color:#fff">
          <button wire:click="import" class="btn btn-success">Importar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Embarque</th>
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @if ($rows)
            {{ $last = '' }}
            @foreach ($rows as $vRow)
              @if ($last == '' || $vRow['number'] != $last)
                <tr>
                  <td>{{ $last = $vRow['number'] }}</td>
                  <td>{{ $vRow['request'] }}</td>
                  <td>{{ $vRow['client'] }}</td>
                  <td>{{ date('d/m/Y', strtotime($vRow['date'])) }}</td>
                </tr>
              @endif
            @endforeach
          @else
            <tr>
              <td colspan="4">Não hà registros</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
