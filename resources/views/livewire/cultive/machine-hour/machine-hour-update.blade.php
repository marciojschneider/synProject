<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Cultivo / Hora Máquinas /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form method="POST" action="{{ route('cultive-machine-hour-update', $id) }}">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="report" class="form-label">Boletim</label>
            <input type="text" class="form-control" id="report" name="report" value="{{ $machine_hour->report }}"
              required />
            {{-- TODO: Adicionar required aos campos. --}}
          </div>

          <div class="col-md-2">
            <label for="field" class="form-label">Talhão</label>
            <select class="form-select" id="field" name="field" wire:model.live="field" required>
              <option value=""> Selecionar </option>
              @foreach ($fields as $field)
                <option value="{{ $field->id }}">
                  {{ mb_strtoupper($field->code, 'UTF-8') }} - {{ mb_strtoupper($field->name, 'UTF-8') }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="organization" class="form-label">Estabelecimento</label>
            <select class="form-control" id="organization" name="organization"
              style="background: #444564; pointer-events: none; touch-action: none;">
              @if ($organization)
                <option value="{{ $organization->id }}" selected> {{ $organization->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="harvest" class="form-label">Safra</label>
            <select class="form-control" id="harvest" name="harvest"
              style="background: #444564; pointer-events: none; touch-action: none;">
              @if ($harvest)
                <option value="{{ $harvest->id }}" selected> {{ $harvest->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="section" class="form-label">Secção</label>
            <select class="form-control" id="section" name="section"
              style="background: #444564; pointer-events: none; touch-action: none;">
              @if ($section)
                <option value="{{ $section->id }}" selected> {{ $section->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <select class="form-control" id="culture" name="culture"
              style="background: #444564; pointer-events: none; touch-action: none;">
              @if ($culture)
                <option value="{{ $culture->id }}" selected> {{ $culture->name }} </option>
              @endif
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="transaction_type" class="form-label">Tipo</label>
            <select id="transaction_type" name="transaction_type" class="form-select"
              wire:model.live="transaction_type">
              <option value="1" {{ $machine_hour->transaction_type == 1 ? 'selected' : '' }}> Estorno </option>
              <option value="2" {{ $machine_hour->transaction_type == 2 ? 'selected' : '' }}> Apropriação
              </option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="transaction_dt" class="form-label">Data</label>
            <input type="date" step="1" class="form-control" id="transaction_dt" name="transaction_dt"
              value="{{ date('Y-m-d', strtotime($machine_hour->transaction_dt)) }}" />
          </div>

          <div class="col-md-2">
            <label for="operator" class="form-label">Operador</label>
            <select id="operator" name="operator" class="form-select" wire:model.live="operator">
              <option selected> Selecionar </option>
              @foreach ($operators as $operator)
                <option value="{{ $operator->id }}">
                  {{ mb_strtoupper($operator->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="process" class="form-label">Processo/Etapa</label>
            <select id="process" name="process" class="form-select" wire:model.live="process">
              <option selected> Selecionar </option>
              @foreach ($processes as $process)
                <option value="{{ $process->id }}">{{ mb_strtoupper($process->code, 'UTF-8') }} -
                  {{ mb_strtoupper($process->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="planting_method" class="form-label">Método Plantio</label>
            <select id="planting_method" name="planting_method" class="form-select" wire:model.live="planting_method">
              <option selected> Selecionar </option>
              @foreach ($planting_methods as $planting_method)
                <option value="{{ $planting_method->id }}">{{ mb_strtoupper($planting_method->code, 'UTF-8') }} -
                  {{ mb_strtoupper($planting_method->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="variety" class="form-label">Variedade</label>
            <select id="variety" name="variety" class="form-select" wire:model.live="variety">
              <option selected> Selecionar </option>
              @foreach ($varieties as $variety)
                <option value="{{ $variety->id }}">{{ mb_strtoupper($variety->code, 'UTF-8') }} -
                  {{ mb_strtoupper($variety->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mb-4">
          <div class="border-bottom">Equipamento</div>
        </div>

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="equipament" class="form-label">Equipamento</label>
            <select id="equipament" name="equipament" class="form-select">
              <option value="1" {{ $machine_hour->equipament_id == 1 ? 'selected' : '' }}>EQUIPAMENTO FICTICIO 01
              </option>
              <option value="2" {{ $machine_hour->equipament_id == 2 ? 'selected' : '' }}>EQUIPAMENTO FICTICIO 02
              </option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="implement" class="form-label">Implemento</label>
            <select id="implement" name="implement" class="form-select">
              <option value="">SELECIONAR</option>
              <option value="1" {{ $machine_hour->implement_id == 1 ? 'selected' : '' }}>IMPLEMENTO FICTICIO 01
              </option>
              <option value="2" {{ $machine_hour->implement_id == 2 ? 'selected' : '' }}>IMPLEMENTO FICTICIO 02
              </option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="hourmeter_start" class="form-label">Horimêtro Inicial</label>
            <input type="text" class="form-control" id="hourmeter_start" name="hourmeter_start"
              wire:model.live="hourmeter_start"" placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_end" class="form-label">Horimêtro Final</label>
            <input type="text" class="form-control" id="hourmeter_end" name="hourmeter_end"
              wire:model.live="hourmeter_end"" placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_quantity" class="form-label">Quantidade</label>
            <input type="text" class="form-control" id="hourmeter_quantity" name="hourmeter_quantity"
              wire:model.live="hourmeter_quantity"" placeholder="0.000,00" readonly />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4"></div>
          <div class="col-md-2">
            <label for="box_quantity" class="form-label">Quantidade Caixas</label>
            <input type="text" class="form-control" id="box_quantity" name="box_quantity"
              value="{{ $machine_hour->quantity_box ? number_format(floatval($machine_hour->quantity_box), 2, ',', '.') : '' }}"
              placeholder="0,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_start" class="form-label">Rotor Inicial</label>
            <input type="text" class="form-control" id="hourmeter_rotor_start" name="hourmeter_rotor_start"
              wire:model.live="hourmeter_rotor_start"" placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_end" class="form-label">Rotor Final</label>
            <input type="text" class="form-control" id="hourmeter_rotor_end" name="hourmeter_rotor_end"
              wire:model.live="hourmeter_rotor_end"" placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_quantity" class="form-label">Quantidade</label>
            <input type="text" class="form-control" id="hourmeter_rotor_quantity" name="hourmeter_rotor_quantity"
              wire:model.live="hourmeter_rotor_quantity" placeholder="0.000,00" readonly />
          </div>
        </div>

        <div class="mb-4">
          <div class="border-bottom">Operador</div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="operator_start" class="form-label">Inicio</label>
            <input class="form-control" type="time" id="operator_start" name="operator_start"
              value="{{ $machine_hour->operator_start }}">
          </div>

          <div class="col-md-4">
            <label for="operator_end" class="form-label">Fim</label>
            <input class="form-control" type="time" id="operator_end" name="operator_end"
              value="{{ $machine_hour->operator_end }}"">
          </div>

          <div class="col-md-4">
            <label for="stop_reason" class="form-label">Motivo Parada</label>
            <select id="stop_reason" name="stop_reason" class="form-select" wire:model.live="stop_reason">
              <option value="">SELECIONAR</option>
              <option value="1" {{ $machine_hour->stop_reason == 1 ? 'selected' : '' }}>1 - Mecânico</option>
              <option value="2" {{ $machine_hour->stop_reason == 2 ? 'selected' : '' }}>2 - Climático</option>
              <option value="3" {{ $machine_hour->stop_reason == 3 ? 'selected' : '' }}>3 - Abastecimento
              </option>
              <option value="4" {{ $machine_hour->stop_reason == 4 ? 'selected' : '' }}>4 - Refeição</option>
            </select>
          </div>
        </div>

        <div class="row mb-4">
          @if ($showStopDetail)
            <div class="col-md-4">
              <label for="description" class="form-label">Descrição</label>
              <input type="text" class="form-control" id="description" name="description"
                value="{{ $machine_hour->stop_description }}" />
            </div>
            <div class="col-md-4">
              <label for="stop_hour" class="form-label">Hora Parada</label>
              <input class="form-control" type="time" id="stop_hour" name="stop_hour"
                value="{{ $machine_hour->stop_hour }}">
            </div>
          @endif
          @if ($showStopDiesel)
            <div class="col-md-2">
              <label for="hourmeter_diesel" class="form-label">Horimetro Diesel</label>
              <input type="text" class="form-control" id="hourmeter_diesel" name="hourmeter_diesel"
                value="{{ $machine_hour->hourmeter_diesel ? number_format(floatval($machine_hour->hourmeter_diesel), 2, ',', '.') : '' }}"
                placeholder="0.000,00" />
            </div>
            <div class="col-md-2">
              <label for="quantity_diesel" class="form-label">Quantidade Diesel</label>
              <input type="text" class="form-control" id="quantity_diesel" name="quantity_diesel"
                value="{{ $machine_hour->quantity_diesel ? number_format(floatval($machine_hour->quantity_diesel), 2, ',', '.') : '' }}"
                placeholder="0,00" />
            </div>
          @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('cultive-machine-hours') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
