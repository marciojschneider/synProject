<?php

namespace App\Livewire\Boarding\Boarding;

use App\Models\Boarding;
use App\Models\BoardingItem;
use Livewire\Component;

// Adicionais
use Illuminate\Support\Facades\File;

class BoardingImport extends Component {
  protected $paginationTheme = 'bootstrap';

  // Variáveis de busca/paginação
  public $pPage = 10;

  public $embarques;

  public function render() {
    $directoryPath = 'C:\Synergya\Integracao\dtssyn'; // Altere o caminho conforme necessário

    if (File::isDirectory($directoryPath)) {
      // $files = File::allFiles($directoryPath); // Busca TODOS os arquivos (incluindo subdiretórios)
      $files = File::files($directoryPath);

      foreach ($files as $file) {
        if ($file->getExtension() === 'csv') {
          $filePath = $file->getRealPath();
          $fileContent = File::get($filePath);

          // Divida o conteúdo em linhas
          $lines = explode(PHP_EOL, $fileContent);

          foreach ($lines as $vLine) {
            // Converta cada linha para um array
            $data = str_getcsv($vLine, ';'); // Use o delimitador correto

            if (count($data) >= 12) {
              $arr['external_id'] = $data[0];
              $arr['item_code'] = $data[1];
              $arr['item_desc'] = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $data[2]);
              $arr['deposit'] = $data[3];
              $arr['location'] = $data[4];
              $arr['batch'] = $data[5];
              $arr['ref'] = $data[6];
              $arr['item_amount'] = $data[7];
              $arr['client'] = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $data[8]);
              $arr['request'] = $data[9];
              $arr['number'] = $data[10];
              $arr['date'] = implode('-', array_reverse(explode('/', $data[11])));
              $arr['request_erp'] = $data[12];
              $arr['archive_name'] = $file->getFilename();
            }

            $this->embarques[] = $arr;
          }
        }
      }
    } else {
      echo 'Diretório não encontrado';
    }

    $data['rows'] = $this->embarques;

    return view('livewire.boarding.boarding.boarding-import', $data);
  }

  public function import() {
    $directoryPath = 'C:\Synergya\Integracao\dtssyn';
    $processedDirectory = 'C:\Synergya\Integracao\dtssyn\imported';

    $request = '';
    $external = '';
    foreach ($this->embarques as $vEmbarque) {
      if ($request == '' || $request != $vEmbarque['request']) {
        $request = $vEmbarque['request'];

        $bInsert = new Boarding();
        $bInsert->number = $vEmbarque['number'];
        $bInsert->request = $vEmbarque['request'];
        $bInsert->date = $vEmbarque['date'];
        $bInsert->client = $vEmbarque['client'];
        $bInsert->client_id = auth()->user()->in_client;
        $bInsert->situation = 1;
        $bInsert->archive_name = $vEmbarque['archive_name'];
        $bInsert->request_erp = $vEmbarque['request_erp'];
        $bInsert->save();
      }

      if ($external == '' || $external != $vEmbarque['external_id']) {
        $external = $vEmbarque['external_id'];

        $iInsert = new BoardingItem();
        $iInsert->boarding_id = $bInsert->id;
        $iInsert->item_code = $vEmbarque['item_code'];
        $iInsert->item_desc = $vEmbarque['item_desc'];
        $iInsert->item_amount = $vEmbarque['item_amount'];
        $iInsert->deposit = $vEmbarque['deposit'];
        $iInsert->location = $vEmbarque['location'];
        $iInsert->batch = $vEmbarque['batch'];
        $iInsert->ref = $vEmbarque['ref'];
        $iInsert->external_id = $vEmbarque['external_id'];
        $iInsert->save();
      }
    }

    if (File::isDirectory($directoryPath)) {
      $files = File::allFiles($directoryPath);

      foreach ($files as $file) {
        if ($file->getExtension() === 'csv') {
          $filePath = $file->getRealPath();

          // Mover o arquivo após processamento
          $destinationPath = $processedDirectory . '/' . $file->getFilename();

          // Verifica se o diretório de destino existe, caso contrário, cria-o
          // if (!File::isDirectory($processedDirectory)) {
          //   File::makeDirectory($processedDirectory, 0755, true);
          // }

          // Mover o arquivo
          File::move($filePath, $destinationPath);

        }
      }
    }

    $this->dispatch('success', ['title' => 'Sucesso']);
  }
}
