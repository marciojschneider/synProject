<div class="col-md">
  <h4 class="mb-4">
    <span class="text-muted fw-light">Cultivo / Hora Máquina /</span> Cadastrar
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
            <div id="fieldContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model.live.click="field" id="field" name="field" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#fieldContainer">
                @foreach ($fields as $field)
                  <option value="{{ $field->id }}">
                    {{ mb_strtoupper($field->code, 'UTF-8') }} - {{ mb_strtoupper($field->name, 'UTF-8') }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="organization" class="form-label">Organização</label>
            <select class="form-control" wire:model="organization"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              <option> ... </option>
              @if ($organization)
                <option value="{{ $organization->id }}" selected> {{ $organization->code }} - {{ $organization->name }}
                </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="harvest" class="form-label">Safra</label>
            <select class="form-control" wire:model="harvest"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              <option> ... </option>
              @if ($harvest)
                <option value="{{ $harvest->id }}" selected> {{ $harvest->code }} - {{ $harvest->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="section" class="form-label">Secção</label>
            <select class="form-control" wire:model="section"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              <option> ... </option>
              @if ($section)
                <option value="{{ $section->id }}" selected> {{ $section->code }} - {{ $section->name }} </option>
              @endif
            </select>
          </div>

          <div class="col-md-2">
            <label for="culture" class="form-label">Cultura</label>
            <select class="form-control" wire:model="culture"
              style="background: #444564; pointer-events: none; touch-action: none;" required>
              <option> ... </option>
              @if ($culture)
                <option value="{{ $culture->id }}" selected> {{ $culture->code }} - {{ $culture->name }} </option>
              @endif
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-2">
            <label for="transaction_type" class="form-label">Tipo</label>
            <div id="transaction_typeContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="transaction_type" id="transaction_type" name="transaction_type"
                class="selectpicker col-sm-12" data-style="btn-default" data-live-search="true" placeholder="SELECIONAR"
                required data-container="#transaction_typeContainer">
                <option value="1">ESTORNO</option>
                <option value="2">APROPRIAÇÃO</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="transaction_dt" class="form-label">Data</label>
            <input type="date" step="1" class="form-control" wire:model="transaction_dt" required />
          </div>

          <div class="col-md-2">
            <label for="operator" class="form-label">Operador</label>
            <div id="operatorContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="operator" id="operator" name="operator" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#operatorContainer">
                @foreach ($operators as $operator)
                  <option value="{{ $operator->id }}">{{ mb_strtoupper($operator->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="process" class="form-label">Processo/Etapa</label>
            <div id="processContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="process" id="process" name="process" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#processContainer">
                @foreach ($processes as $process)
                  <option value="{{ $process->id }}">{{ mb_strtoupper($process->code, 'UTF-8') }} -
                    {{ mb_strtoupper($process->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="planting_method" class="form-label">Método Plantio</label>
            <div id="planting_methodContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="planting_method" id="planting_method" name="planting_method"
                class="selectpicker col-sm-12" data-style="btn-default" data-live-search="true"
                placeholder="SELECIONAR" required data-container="#planting_methodContainer">
                @foreach ($planting_methods as $planting_method)
                  <option value="{{ $planting_method->id }}">{{ mb_strtoupper($planting_method->code, 'UTF-8') }} -
                    {{ mb_strtoupper($planting_method->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <label for="variety" class="form-label">Variedade</label>
            <div id="varietyContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="variety" id="variety" name="variety" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#varietyContainer">
                @foreach ($varieties as $variety)
                  <option value="{{ $variety->id }}">{{ mb_strtoupper($variety->code, 'UTF-8') }} -
                    {{ mb_strtoupper($variety->name, 'UTF-8') }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <div class="border-bottom">Equipamento</div>
        </div>

        <div class="row mb-4">
          <div class="col-md-3">
            <label for="equipament" class="form-label">Equipamento</label>
            <div id="equipamentContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="equipament" id="equipament" name="equipament" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR" required
                data-container="#equipamentContainer">
                <option value="1">EQUIPAMENTO FICTICIO 01</option>
                <option value="2">EQUIPAMENTO FICTICIO 02</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label for="implement" class="form-label">Implemento</label>
            <div id="implementContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model="implement" id="implement" name="implement" class="selectpicker col-sm-12"
                data-style="btn-default" data-live-search="true" placeholder="SELECIONAR"
                data-container="#implementContainer">
                <option value="1">IMPLEMENTO FICTICIO 01</option>
                <option value="2">IMPLEMENTO FICTICIO 02</option>
              </select>
            </div>
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
            <div id="stop_reasonContainer" class="dataTables_filter" bis_skin_checked="1" wire:ignore>
              <select wire:model.live.click="stop_reason" id="stop_reason" name="stop_reason"
                class="selectpicker col-sm-12" data-style="btn-default" data-live-search="true"
                placeholder="SELECIONAR" data-container="#stop_reasonContainer">
                <option value="1">1 - MECÂNICO</option>
                <option value="2">2 - CLIMÁTICO</option>
                <option value="3">3 - ABASTECIMENTO</option>
                <option value="4">4 - REFEIÇÃO</option>
              </select>
            </div>
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
