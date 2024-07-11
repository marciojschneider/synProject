<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Cultivo / Hora Máquina /</span> Atualizar
  </h4>
  <div class="card mb-4">
    {{-- <h5 class="card-header">Novo chamado</h5> --}}
    <div class="card-body">
      <form wire:submit.prevent="submit">
        @csrf

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="report" class="form-label">Boletim</label>
            <input type="text" class="form-control" wire:model="report" required />
          </div>

          <div class="col-md-2">
            <label for="field" class="form-label">Talhão</label>
            <select class="form-select" wire:model.live="field" required>
              <option value="" selected> Selecionar </option>
              @foreach ($fields as $field)
                <option value="{{ $field->id }}">
                  {{ mb_strtoupper($field->code, 'UTF-8') }} - {{ mb_strtoupper($field->name, 'UTF-8') }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="organization" class="form-label">Estabelecimento</label>
            <select class="form-control" wire:model="organization"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              @if ($organization)
                <option value="{{ $organization->id }}" selected> {{ $organization->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="harvest" class="form-label">Safra</label>
            <select class="form-control" wire:model="harvest"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              @if ($harvest)
                <option value="{{ $harvest->id }}" selected> {{ $harvest->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="section" class="form-label">Secção</label>
            <select class="form-control" wire:model="section"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              @if ($section)
                <option value="{{ $section->id }}" selected> {{ $section->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <select class="form-control" wire:model="culture"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              @if ($culture)
                <option value="{{ $culture->id }}" selected> {{ $culture->name }} </option>
              @endif
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="transaction_type" class="form-label">Tipo</label>
            <select class="form-select" wire:model="transaction_type" required>
              <option value="" selected> Selecionar </option>
              <option value="1">Estorno</option>
              <option value="2">Apropriação</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="transaction_dt" class="form-label">Data</label>
            <input type="date" step="1" class="form-control" wire:model="transaction_dt" required />
          </div>

          <div class="col-md-2">
            <label for="operator" class="form-label">Operador</label>
            <select class="form-select" wire:model="operator" required>
              <option value="" selected> Selecionar </option>
              @foreach ($operators as $operator)
                <option value="{{ $operator->id }}">{{ mb_strtoupper($operator->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="process" class="form-label">Processo/Etapa</label>
            <select class="form-select" wire:model="process" required>
              <option value="" selected> Selecionar </option>
              @foreach ($processes as $process)
                <option value="{{ $process->id }}">{{ mb_strtoupper($process->code, 'UTF-8') }} -
                  {{ mb_strtoupper($process->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="planting_method" class="form-label">Método Plantio</label>
            <select class="form-select" wire:model="planting_method" required>
              <option value="" selected> Selecionar </option>
              @foreach ($planting_methods as $planting_method)
                <option value="{{ $planting_method->id }}">{{ mb_strtoupper($planting_method->code, 'UTF-8') }} -
                  {{ mb_strtoupper($planting_method->name, 'UTF-8') }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="variety" class="form-label">Variedade</label>
            <select class="form-select" wire:model="variety" required>
              <option value="" selected> Selecionar </option>
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
            <select class="form-select" wire:model="equipament" required>
              <option value="" selected>SELECIONAR</option>
              <option value="1">EQUIPAMENTO FICTICIO 01</option>
              <option value="2">EQUIPAMENTO FICTICIO 02</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="implement" class="form-label">Implemento</label>
            <select class="form-select" wire:model="implement">
              <option value="" selected>SELECIONAR</option>
              <option value="1">IMPLEMENTO FICTICIO 01</option>
              <option value="2">IMPLEMENTO FICTICIO 02</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="hourmeter_start" class="form-label">Horimêtro Inicial</label>
            <input type="text" class="form-control" wire:model="hourmeter_start" placeholder="0.000,00"
              required />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_end" class="form-label">Horimêtro Final</label>
            <input type="text" class="form-control" wire:model.live="hourmeter_end" placeholder="0.000,00"
              required />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_quantity" class="form-label">Quantidade</label>
            <input type="text" class="form-control" wire:model="hourmeter_quantity" placeholder="0.000,00"
              readonly required />
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4"></div>
          <div class="col-md-2">
            <label for="box_quantity" class="form-label">Quantidade Caixas</label>
            <input type="text" class="form-control" wire:model="box_quantity" placeholder="0,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_start" class="form-label">Rotor Inicial</label>
            <input type="text" class="form-control" wire:model="hourmeter_rotor_start" placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_end" class="form-label">Rotor Final</label>
            <input type="text" class="form-control" wire:model.live="hourmeter_rotor_end"
              placeholder="0.000,00" />
          </div>

          <div class="col-md-2">
            <label for="hourmeter_rotor_quantity" class="form-label">Quantidade</label>
            <input type="text" class="form-control" wire:model="hourmeter_rotor_quantity" placeholder="0.000,00"
              readonly />
          </div>
        </div>

        <div class="mb-4">
          <div class="border-bottom">Operador</div>
        </div>

        <div class="row mb-4">
          <div class="col-md-4">
            <label for="operator_start" class="form-label">Inicio</label>
            <input class="form-control" type="time" wire:model="operator_start">
          </div>

          <div class="col-md-4">
            <label for="operator_end" class="form-label">Fim</label>
            <input class="form-control" type="time" wire:model="operator_end">
          </div>

          <div class="col-md-4">
            <label for="stop_reason" class="form-label">Motivo Parada</label>
            <select class="form-select" wire:model.live="stop_reason">
              <option value="" selected>SELECIONAR</option>
              <option value="1">1 - Mecânico</option>
              <option value="2">2 - Climático</option>
              <option value="3">3 - Abastecimento</option>
              <option value="4">4 - Refeição</option>
            </select>
          </div>
        </div>

        <div class="row mb-4">
          @if ($showStopDetail)
            <div class="col-md-4">
              <label for="description" class="form-label">Descrição</label>
              <input type="text" class="form-control" wire:model="description" />
            </div>
            <div class="col-md-4">
              <label for="stop_hour" class="form-label">Hora Parada</label>
              <input class="form-control" type="time" wire:model="stop_hour">
            </div>
          @endif
          @if ($showStopDiesel)
            <div class="col-md-2">
              <label for="hourmeter_diesel" class="form-label">Horimetro Diesel</label>
              <input type="text" class="form-control" wire:model="hourmeter_diesel" placeholder="0.000,00" />
            </div>
            <div class="col-md-2">
              <label for="quantity_diesel" class="form-label">Quantidade Diesel</label>
              <input type="text" class="form-control" wire:model="quantity_diesel" placeholder="0,00" />
            </div>
          @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('cultive-machine-hours') }}" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>
