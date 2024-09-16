<?php

namespace App\Livewire\Boarding\Boarding;

use App\Models\BoardingItem;
use App\Models\BoardingReading;
use App\Models\StBoarding;
use App\Models\StBoardingItem;
use App\Models\StBoardingReading;
use Livewire\Component;

// Adicionais
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Boarding;
use App\Models\User;

class BoardingExport extends Component {
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $pPage = 10;

  public function mount() {
    // Caso precise pré carregar selects, declare a váriavel e faça a busca por aqui!
  }

  // Essa função fica responsável por atualizar a pagina SEMPRE que houver qualquer alteração
  // (ex.: Realoca o usuário para a pagina 1 mesmo ele estando na página 20 após uma nova busca / troca de número de registros).
  public function updated() {
    $this->resetPage();
  }

  public function render() {
    $user = auth()->user();

    $query = Boarding::query();
    $query->where('client_id', $user->in_client);
    $query->where('situation', 4);
    $query->get();

    $data['rows'] = $query->paginate($this->pPage);

    foreach ($data['rows'] as $kBoarding => $vBoarding) {
      $data['rows'][$kBoarding]['id'] = $vBoarding->id;

      if ($vBoarding->separador) {
        $separador = User::where('id', $vBoarding->separador)->select('name')->first();
        if ($separador) {
          $data['rows'][$kBoarding]['uName'] = $separador->name;
        }
      }
    }

    return view('livewire.boarding.boarding.boarding-export', $data);
  }

  public function export() {
    // Escreve o cabeçalho das colunas no arquivo CSV
    // fputcsv($file, ['ID', 'Name', 'Email']);

    // Busca os dados do banco de dados (ajuste conforme necessário)
    $boardings = Boarding::where('client_id', auth()->user()->in_client)->where('situation', 4)->get();

    // Itera sobre os dados e escreve cada linha no CSV
    foreach ($boardings as $boarding) {
      $exportItems = BoardingReading::join('boarding_items', 'boarding_readings.item_code', '=', 'boarding_items.item_code')
        ->where('boarding_items.boarding_id', $boarding->id)->where('boarding_readings.boarding_id', $boarding->id)
        ->select('boarding_readings.external_id', 'boarding_readings.item_code', 'boarding_items.item_desc', 'boarding_items.deposit', 'boarding_items.location', 'boarding_readings.batch', 'boarding_items.ref', DB::raw('SUM(boarding_readings.amount) as amount'))
        ->groupBy('boarding_readings.external_id', 'boarding_readings.item_code', 'boarding_items.item_desc', 'boarding_items.deposit', 'boarding_items.location', 'boarding_readings.batch', 'boarding_items.ref', 'amount')
        ->get();

      // Define o nome do arquivo CSV
      $fileName = (string) $boarding->archive_name;

      // Define o caminho completo onde o arquivo será salvo
      $filePath = "C:\Synergya\Integracao\syndts\ $fileName";

      // Garante que o diretório exista, se não existir, cria-o
      if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0777, true);
      }

      // Abre o arquivo para escrita
      $file = fopen($filePath, 'w');

      foreach ($exportItems as $exportItem) {
        $line = implode(';', [
          $exportItem->external_id,
          '"' . strval($exportItem->item_code) . '"',
          '"' . strval($exportItem->item_desc) . '"',
          '"' . strval($exportItem->deposit) . '"',
          '"' . strval($exportItem->location) . '"',
          '"' . strval($exportItem->batch) . '"',
          '"' . strval($exportItem->ref) . '"',
          $exportItem->amount,
          '"' . strval($boarding->client) . '"',
          '"' . strval($boarding->request) . '"',
          $boarding->number,
          implode('/', array_reverse(explode('-', $boarding->date))),
        ]);

        // Escrevendo a linha no arquivo
        fwrite($file, $line . PHP_EOL);
      }

      $stBoardingTable = new StBoarding();
      $stBoardingTable->id = $boarding->id;
      $stBoardingTable->number = $boarding->number;
      $stBoardingTable->request = $boarding->request;
      $stBoardingTable->date = $boarding->date;
      $stBoardingTable->client = $boarding->client;
      $stBoardingTable->client_id = $boarding->client_id;
      $stBoardingTable->separador = $boarding->separador;
      $stBoardingTable->situation = 5;
      $stBoardingTable->archive_name = $boarding->archive_name;
      $stBoardingTable->request_erp = $boarding->request_erp;
      $stBoardingTable->save();

      $this->exportRegisters($boarding->id);
    }

    // Fecha o arquivo após a escrita
    fclose($file);
  }

  public function exportRegisters($id) {
    $boardingItems = BoardingItem::where('boarding_id', $id)->get();
    // dd($boardingItems);
    foreach ($boardingItems as $boardingItem) {
      $stBoardingItemTable = new StBoardingItem();
      $stBoardingItemTable->id = $boardingItem->id;
      $stBoardingItemTable->boarding_id = $boardingItem->boarding_id;
      $stBoardingItemTable->item_code = $boardingItem->item_code;
      $stBoardingItemTable->item_desc = $boardingItem->item_desc;
      $stBoardingItemTable->item_amount = $boardingItem->item_amount;
      $stBoardingItemTable->deposit = $boardingItem->deposit;
      $stBoardingItemTable->location = $boardingItem->location;
      $stBoardingItemTable->batch = $boardingItem->batch;
      $stBoardingItemTable->ref = $boardingItem->ref;
      $stBoardingItemTable->external_id = $boardingItem->external_id;
      $stBoardingItemTable->exported = 1;
      $stBoardingItemTable->save();
    }

    $boardingReadings = BoardingReading::where('boarding_id', $id)->get();
    // dd($boardingReadings);
    foreach ($boardingReadings as $boardingReading) {
      $stBoardingReadingTable = new StBoardingReading();
      $stBoardingReadingTable->id = $boardingReading->id;
      $stBoardingReadingTable->boarding_id = $boardingReading->boarding_id;
      $stBoardingReadingTable->deposit = $boardingReading->deposit;
      $stBoardingReadingTable->location = $boardingReading->location;
      $stBoardingReadingTable->batch = $boardingReading->batch;
      $stBoardingReadingTable->amount = $boardingReading->amount;
      $stBoardingReadingTable->item_code = $boardingReading->item_code;
      $stBoardingReadingTable->seq = $boardingReading->seq;
      $stBoardingReadingTable->full_code = $boardingReading->full_code;
      $stBoardingReadingTable->external_id = $boardingReading->external_id;
      $stBoardingReadingTable->user_id = $boardingReading->user_id;
      $stBoardingReadingTable->exported = $boardingReading->exported;
      $stBoardingReadingTable->hr_read = $boardingReading->hr_read;
      $stBoardingReadingTable->dt_read = $boardingReading->dt_read;
      $stBoardingReadingTable->pallet = $boardingReading->pallet;
      $stBoardingReadingTable->devolution = $boardingReading->devolution;
      $stBoardingReadingTable->save();
    }

    BoardingItem::where('boarding_id', $id)->delete();
    BoardingReading::where('boarding_id', $id)->delete();
    Boarding::where('id', $id)->delete();
  }
}
