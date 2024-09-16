<?php

namespace App\Livewire\Boarding\Boarding;

use Livewire\Component;

// Adicionais
use Illuminate\Support\Facades\DB;

// Models
use App\Models\UserProfile;
use App\Models\Boarding;
use App\Models\StBoarding;
use App\Models\BoardingItem;
use App\Models\StBoardingItem;
use App\Models\BoardingReading;
use App\Models\StBoardingReading;

class BoardingUpdate extends Component {
  // Register
  public $id, $boarding;

  // 1° Row
  public $number, $request, $date, $separadores = [], $separador, $situation, $rows;

  // Control
  public $st = false;

  public function mount() {
    $user = auth()->user();

    $this->separadores = UserProfile::where('profile_id', 5)
      ->join('users', 'users.id', '=', 'user_profiles.user_id')
      ->where('client_id', $user->in_client)
      ->where('user_profiles.situation', 1)
      ->get();

    $this->boarding = Boarding::where('id', $this->id)
      ->where('client_id', $user->in_client)
      ->first();

    if (!$this->boarding) {
      $this->boarding = StBoarding::where('id', $this->id)
        ->where('client_id', $user->in_client)
        ->first();

      if (!$this->boarding) {
        return redirect()->route('boar-boardings');
      }

      // Verificar necessidade
      $this->st = true;
    }

    $this->number = $this->boarding->number;
    $this->request = $this->boarding->request;
    $this->date = $this->boarding->date;
    $this->separador = $this->boarding->separador;
    $this->situation = match ($this->boarding->situation) {
      1 => 'SEM SEPARADOR',
      2 => 'SEM LEITURA',
      3 => 'COM LEITURA',
      4 => 'FINALIZADO',
      5 => 'EXPORTADO',
    };

    $itemClass = $this->st ? StBoardingItem::class : BoardingItem::class;
    $tableName = (new $itemClass)->getTable(); // Obtem o nome da tabela usando o método getTable()
    $this->rows = $itemClass::join('items', 'items.code', '=', $tableName . '.item_code')->where('boarding_id', $this->id)->get();

    foreach ($this->rows as $kRow => $vRow) {
      $readingClass = $this->st ? StBoardingReading::class : BoardingReading::class;

      $this->rows[$kRow]->box = $vRow->item_amount / $vRow->amount;
      $read = $readingClass::where('item_code', $vRow->item_code)->where('boarding_id', $this->id)->select(DB::raw('SUM(amount) as read_amount'))->get();
      $this->rows[$kRow]->read_amount = $read[0]->read_amount ?: 0;
    }

    // Ajuste para o funcionamento correto do SelectPicker
    $this->dispatch('loadDataSelect', ['separador' => $this->separador, 'situation' => $this->situation]);
  }

  protected $rules = [
    'separador' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->boarding->separador = $this->separador;
    if ($this->boarding->situation == 1) {
      $this->boarding->situation = 2;
    }
    $this->boarding->save();

    return redirect()->route('boar-boardings');
  }
}
