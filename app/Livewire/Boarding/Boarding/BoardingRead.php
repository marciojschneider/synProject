<?php

namespace App\Livewire\Boarding\Boarding;

use App\Models\BoardingItem;
use Livewire\Component;

// Adicionais
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Boarding;
use App\Models\BoardingReading;
use App\Models\Item;
use App\Models\User;

class BoardingRead extends Component {
  // Register
  public $id, $boarding;

  // 1° Row
  public $number, $request, $date, $separador, $situation, $rows;

  // 2° Row
  public $codeRead;

  // Control
  public $st = false;

  public function mount() {
    $user = auth()->user();

    $this->boarding = Boarding::where('id', $this->id)
      ->where('client_id', $user->in_client)
      ->where('separador', $user->id)
      ->first();

    if (!$this->boarding) {
      return redirect()->route('boar-boardings');
    }

    $this->number = $this->boarding->number;
    $this->request = $this->boarding->request;
    $this->date = $this->boarding->date;

    $separador = User::where('id', $this->boarding->separador)->select('name')->first();
    $this->separador = $separador['name'];

    $this->situation = match ($this->boarding->situation) {
      1 => 'SEM SEPARADOR',
      2 => 'SEM LEITURA',
      3 => 'COM LEITURA',
      4 => 'FINALIZADO',
      5 => 'EXPORTADO',
    };

    $this->rows = BoardingItem::join('items', 'items.code', '=', 'boarding_items.item_code')
      ->where('boarding_id', $this->id)
      ->get();

    foreach ($this->rows as $kRow => $vRow) {
      $this->rows[$kRow]->box = $vRow->item_amount / $vRow->amount;

      $read = BoardingReading::where('item_code', $vRow->item_code)->where('boarding_id', $this->id)->where('external_id', $vRow->external_id)
        ->select(DB::raw('SUM(amount) as read_amount'))->get();

      $this->rows[$kRow]->read_amount = $read[0]->read_amount ?: 0;
    }

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['separador' => $this->separador, 'situation' => $this->situation]);
  }

  public function updatedCodeRead() {
    if ($this->codeRead) {
      $resto = 0;

      $replaced = str_replace(' ', '', $this->codeRead);
      $pallet = stristr($this->codeRead, 'P') ? true : false;
      $arr = str_contains($replaced, '-') ? explode("-", $replaced) : explode('P', $replaced);

      if (!isset($arr[1]) || strlen($arr[1]) != 11) {
        $this->codeRead = '';
        $this->dispatch('error', ['msg' => 'Código inválido']);
        return;
      }

      $cut = str_split($arr[1]);

      if ($pallet) {
        $date = "$cut[0]$cut[1]";
        $batch = "$date$cut[2]$cut[3]$cut[4]";
        $qtdPallet = "$cut[5]$cut[6]$cut[7]";
        $seqBox = "$cut[8]$cut[9]$cut[10]";

        // Pegar quantidade do item
        $amount = Item::where('items.code', $arr[0])->join('boarding_items', 'items.code', '=', 'boarding_items.item_code')->select('boarding_items.boarding_id', $this->id)->select('amount as qtd')->get();
        if (!isset($amount[0])) {
          $this->codeRead = '';
          $this->dispatch('error', ['msg' => 'Este item não foi cadastrado no embarque atual.']);
          return;
        }
        $amount = $amount[0]->qtd * $qtdPallet;

        // Verificar se o código lido já foi utilizado
        $codeUsed = BoardingReading::where('boarding_readings.full_code', $replaced)->first();
        if ($codeUsed) {
          $this->codeRead = '';
          $this->dispatch('error', ['msg' => 'O código informado já foi utilizado.']);
          return;
        }

        $readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as readed'))->first();
        if (!$readed->readed) {
          $readed->readed = 0;
        }

        // Verificar todos os possiveis external_id's
        $arr_external = BoardingItem::where('item_code', $arr[0])->where('boarding_id', $this->id)->groupBy('external_id')->groupBy('item_amount')->select('external_id', 'item_amount as max')->get();
        $total = BoardingItem::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(item_amount) as total'))->first();
        $total_readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as total_readed'))->first();

        foreach ($arr_external as $vExternal) {
          $readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->where('external_id', $vExternal->external_id)->select(DB::raw('SUM(amount) as readed'))->first();
          $sum = $amount + $readed->readed;

          if ($resto > 0) {
            $this->insertData(new BoardingReading(), $batch, $resto, $arr[0], $seqBox, $replaced, $vExternal->external_id, 1);
            return redirect()->route('boar-boarding-read', $this->id);
          }

          if ($sum <= $vExternal->max) {
            $this->insertData(new BoardingReading(), $batch, $amount, $arr[0], $seqBox, $replaced, $vExternal->external_id, 1);
            return redirect()->route('boar-boarding-read', $this->id);
          }

          if ($readed->readed < $vExternal->max) {
            $qtd = $amount;
            if ($qtd >= $vExternal->max) {
              $qtd = $vExternal->max;
            }

            if ($total->total > $vExternal->max && $readed->readed < $vExternal->max) {
              $resto = $vExternal->max - $readed->readed;

              if ($readed->readed + $resto < $vExternal->max) {
                $this->insertData(new BoardingReading(), $batch, $qtd, $arr[0], $seqBox, $replaced, $vExternal->external_id, 1);
              }

              if ($readed->readed + $resto == $vExternal->max) {
                $this->insertData(new BoardingReading(), $batch, $resto, $arr[0], $seqBox, $replaced, $vExternal->external_id, 1);
                $resto = $qtd - $resto;
              }
            }
          }

          if ($total_readed->total_readed + $amount > $total->total) {
            $this->codeRead = '';
            $this->dispatch('error', ['msg' => 'Este item já atingiu a quantidade máxima.']);
            return;
          }
        }
      }

      if (!$pallet) {
        $date = "$cut[0]$cut[1]";
        $batch = "$date$cut[2]$cut[3]$cut[4]";
        $zerozero = "$cut[5]$cut[6]";
        $seqBox = "$cut[7]$cut[8]$cut[9]$cut[10]";

        // Pegar quantidade do item
        $amount = Item::where('items.code', $arr[0])->join('boarding_items', 'items.code', '=', 'boarding_items.item_code')->select('boarding_items.boarding_id', $this->id)->select('amount as qtd')->get();
        if (!isset($amount[0])) {
          $this->codeRead = '';
          $this->dispatch('error', ['msg' => 'Este item não foi cadastrado no embarque atual.']);
          return;
        }

        // Verificar se o código lido já foi utilizado
        $codeUsed = BoardingReading::where('boarding_readings.full_code', $replaced)->first();
        if ($codeUsed) {
          $this->codeRead = '';
          $this->dispatch('error', ['msg' => 'O código informado já foi utilizado.']);
          return;
        }

        $readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as readed'))->first();
        if (!$readed->readed) {
          $readed->readed = 0;
        }

        // Verificar todos os possiveis external_id's
        $arr_external = BoardingItem::where('item_code', $arr[0])->where('boarding_id', $this->id)->groupBy('external_id')->groupBy('item_amount')->select('external_id', 'item_amount as max')->get();
        $total = BoardingItem::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(item_amount) as total'))->first();
        $total_readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as total_readed'))->first();

        foreach ($arr_external as $vExternal) {
          $readed = BoardingReading::where('item_code', $arr[0])->where('boarding_id', $this->id)->where('external_id', $vExternal->external_id)->select(DB::raw('SUM(amount) as readed'))->first();
          $sum = $amount[0]->qtd + $readed->readed;

          if ($resto > 0) {
            $this->insertData(new BoardingReading(), $batch, $resto, $arr[0], $seqBox, $replaced, $vExternal->external_id, 0);
            return redirect()->route('boar-boarding-read', $this->id);
          }

          if ($sum <= $vExternal->max) {
            $this->insertData(new BoardingReading(), $batch, $amount[0]->qtd, $arr[0], $seqBox, $replaced, $vExternal->external_id, 0);
            return redirect()->route('boar-boarding-read', $this->id);
          }

          if ($readed->readed < $vExternal->max) {
            $qtd = $amount[0]->qtd;
            if ($qtd >= $vExternal->max) {
              $qtd = $vExternal->max;
            }

            if ($total->total > $vExternal->max && $readed->readed < $vExternal->max) {
              $resto = $vExternal->max - $readed->readed;

              if ($readed->readed + $resto < $vExternal->max) {
                $this->insertData(new BoardingReading(), $batch, $qtd, $arr[0], $seqBox, $replaced, $vExternal->external_id, 0);
              }

              if ($readed->readed + $resto == $vExternal->max) {
                $this->insertData(new BoardingReading(), $batch, $resto, $arr[0], $seqBox, $replaced, $vExternal->external_id, 0);
                $resto = $qtd - $resto;
              }
            }

            continue;
          }

          if ($total_readed->total_readed + $amount[0]->qtd > $total->total) {
            $this->codeRead = '';
            $this->dispatch('error', ['msg' => 'Este item já atingiu a quantidade máxima.']);
            return;
          }
        }
      }
    }
  }

  public function adjustSituation() {
    $need = BoardingItem::where('boarding_id', $this->id)->select(DB::raw('SUM(item_amount) as need'))->first();
    $amount = BoardingReading::where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as amount'))->first();

    if ($amount->amount > 0 && $amount->amount < $need->need) {
      $update = Boarding::find($this->id);
      $update->situation = 3;
      $update->save();
    }

    if ($need->need == $amount->amount) {
      $update = Boarding::find($this->id);
      $update->situation = 4;
      $update->save();
    }

    return redirect()->route('boar-boarding-read', $this->id);
  }

  public function insertData($insert, $batch, $qtd, $code, $seq_box, $full_code, $external_id, $pallet) {
    $insert->boarding_id = $this->id;
    $insert->batch = $batch;
    $insert->amount = $qtd;
    $insert->item_code = $code;
    $insert->seq = $seq_box;
    $insert->full_code = $full_code;
    $insert->external_id = $external_id;
    $insert->user_id = auth()->user()->id;
    $insert->hr_read = now();
    $insert->dt_read = now();
    $insert->pallet = $pallet;
    $insert->save();

    if ($insert->id) {
      $this->adjustSituation();
    }
  }
}
